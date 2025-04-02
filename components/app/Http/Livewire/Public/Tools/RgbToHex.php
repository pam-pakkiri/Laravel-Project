<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RgbToHexClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class RgbToHex extends Component
{

    public $hex_color;
    public $red_color;
    public $green_color;
    public $blue_color;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.rgb-to-hex');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onRgbToHex
     * -------------------------------------------------------------------------------
    **/
    public function onRgbToHex(){

        $validationRules = [
            'red_color'   => 'required|numeric',
            'green_color' => 'required|numeric',
            'blue_color'  => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new RgbToHexClass();

            $this->data = $output->get_data( $this->red_color, $this->green_color, $this->blue_color );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $this->hex_color = $this->data['hex_color'];
            $this->dispatchBrowserEvent('showPreview', ['preview_color' => $this->data['hex_color'] ]);

            $history             = new History;
            $history->tool_name  = 'RGB to HEX';
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
        $this->red_color   = '255';
        $this->green_color = '0';
        $this->blue_color  = '0';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->red_color   = null;
        $this->green_color = null;
        $this->blue_color  = null;
        $this->data        = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetRedColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetRedColor($value)
    {
        $this->red_color = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetGreenColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetGreenColor($value)
    {
        $this->green_color = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetBlueColor
     * -------------------------------------------------------------------------------
    **/
    public function onSetBlueColor($value)
    {
        $this->blue_color = $value;
    }
}
