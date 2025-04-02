<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\LoremIpsumGeneratorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class LoremIpsumGenerator extends Component
{

    public $type = 'paragraphs';
    public $number = 5;
    public $html_markup = 'no';
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.lorem-ipsum-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onLoremIpsumGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onLoremIpsumGenerator(){

        $validationRules = [
            'type'        => 'required',
            'number'      => 'required|numeric',
            'html_markup' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new LoremIpsumGeneratorClass();

                $this->data = $output->get_data( $this->type, $this->number, $this->html_markup );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Lorem Ipsum Generator';
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
    }
}
