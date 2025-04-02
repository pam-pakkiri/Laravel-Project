<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JsonValidator extends Component
{

    public $json;
    public $data;
    public $recaptcha;
    protected $listeners = ['onSetJsonData'];

    public function render()
    {
        return view('livewire.public.tools.json-validator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetJsonData
     * -------------------------------------------------------------------------------
    **/
    public function onSetJsonData($value)
    {
        $this->json = $value;
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  isJson
     * -------------------------------------------------------------------------------
    **/
    private function isJson($string) {

       json_decode($string);

       return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJsonValidator
     * -------------------------------------------------------------------------------
    **/
    public function onJsonValidator(){

        $validationRules = [
            'json'   => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                if ( $this->isJson($this->json) == true ) {

                    session()->flash('status', 'success');
                    session()->flash('message', __('JSON is valid!'));

                } else {

                    session()->flash('status', 'error');
                    session()->flash('message', __('JSON is not valid!'));
                }

                $this->dispatchBrowserEvent('resetReCaptcha');
            
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'JSON Validator';
        $history->client_ip  = request()->ip();

        require app_path('Classes/geoip2.phar');

        $reader = new Reader( app_path('Classes/GeoLite2-City.mmdb') );

        try {

            $record           = $reader->city( request()->ip() );

            $history->flag    = strtolower( $record->country->isoCode );
            
            $history->country = strip_tags( $record->country->name );

        } catch (AddressNotFoundException $e) {

        }

        $history->created_at = new DateTime();
        $history->save();

    }

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->dispatchBrowserEvent('onSample', ['json' => '{
  "firstName": "John",
  "lastName": "Smith",
  "gender": "man",
  "age": 30,
  "address": {
    "streetAddress": "150",
    "city": "San Diego",
    "state": "CA",
    "postalCode": "263142"
  }
}']);
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->dispatchBrowserEvent('onReset', ['json' => '{}']);
        $this->data = null;
    }
}
