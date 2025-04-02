<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\BinaryToAsciiClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class BinaryToAscii extends Component
{
    public $binary;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.binary-to-ascii');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onBinaryToAscii
     * -------------------------------------------------------------------------------
    **/
    public function onBinaryToAscii(){

        $validationRules = [
            'binary' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new BinaryToAsciiClass();

                $this->data = $output->get_data( $this->binary );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Binary to ASCII';
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
        $this->binary = '01001000011010010010110000100000010100110110000101101101011100000110110001100101001000000101010001100101011110000111010000100001';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
		$this->data = null;
        $this->binary = null;
        $this->data   = null;
    }
}
