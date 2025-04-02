<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JsonToText extends Component
{

    public $json;
    public $data;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.json-to-text');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJsonToText
     * -------------------------------------------------------------------------------
    **/
    public function onJsonToText(){

        $validationRules = [
            'json'   => 'required|json'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $deJson = json_decode($this->json, true);

                $result = '';

                foreach ($deJson as $key => $value) {

                    foreach ($value as $textKey => $textValue) {
                        $result .= $textKey . ' ' . $textValue . PHP_EOL;
                    }

                }

                $this->data = $result;

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'JSON to Text';
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
        $this->json = '[{"Album":"The White Stripes","Year":"1999"},{"Album":"De Stijl","Year":"2000"}]';
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->json = '';
        $this->data = null;
    }
}
