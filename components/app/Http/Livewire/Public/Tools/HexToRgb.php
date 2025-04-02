<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\HexToRgbClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class HexToRgb extends Component
{

    public $hex_color;
    public $red_color;
    public $green_color;
    public $blue_color;
    public $css_color;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.hex-to-rgb');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onHexToRgb
     * -------------------------------------------------------------------------------
    **/
    public function onHexToRgb(){

        $validationRules = [
            'hex_color' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new HexToRgbClass();

            $this->data = $output->get_data( $this->hex_color );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $this->red_color   = $this->data['red'];
            $this->green_color = $this->data['green'];
            $this->blue_color  = $this->data['blue'];
            $this->css_color   = 'rgb('.$this->data['red'].', '.$this->data['green'].', '.$this->data['blue'].')';

            $this->dispatchBrowserEvent('showPreview', ['css_color' => $this->css_color ]);

            $history             = new History;
            $history->tool_name  = 'HEX to RGB';
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

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->hex_color = '#FF0000';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->hex_color = null;
        $this->data      = null;
    }

}
