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

class XmlToJson extends Component
{

    public $xml;
    public $data;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.xml-to-json');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onXmlToJson
     * -------------------------------------------------------------------------------
    **/
    public function onXmlToJson(){

        $validationRules = [
            'xml' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $xml = simplexml_load_string($this->xml);

            $json = json_encode($xml);

            $this->data = $json;

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'XML to JSON';
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
        $this->xml = '<?xml version="1.0"?>
<root>
  <firstName>John</firstName>
  <lastName>Smith</lastName>
  <gender>man</gender>
  <age>30</age>
  <address>
    <streetAddress>150</streetAddress>
    <city>San Diego</city>
    <state>CA</state>
    <postalCode>263142</postalCode>
  </address>
</root>';
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->xml = '';
        $this->data = null;
    }

}
