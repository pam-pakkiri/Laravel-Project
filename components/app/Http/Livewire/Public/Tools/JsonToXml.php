<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use Spatie\ArrayToXml\ArrayToXml;
use DOMDocument;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JsonToXml extends Component
{

    public $json;
    public $data;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.json-to-xml');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJsonToXml
     * -------------------------------------------------------------------------------
    **/
    public function onJsonToXml(){

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

                $xml = ArrayToXml::convert($deJson);

                $dom = new DOMDocument('1.0');
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = true;
                $dom->loadXML($xml);

                $this->data = $dom->saveXML();

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'JSON to XML';
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
        $this->json = '{
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
}';
        
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
