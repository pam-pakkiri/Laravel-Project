<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class GstCalculator extends Component
{

    public $gst = 'exclusive';
    public $amount;
    public $rate;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.gst-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onGstCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onGstCalculator(){

        $validationRules = [
            'gst'    => 'required',
            'amount' => 'required|numeric',
            'rate'   => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {
            switch ($this->gst) {

                case 'exclusive':

                     $this->data['net_amount'] = number_format($this->amount, 2);

                     $this->data['gst_amount'] = number_format(($this->rate / 100) * $this->amount, 2);

                     $this->data['gross_amount'] = number_format((1 + $this->rate / 100) * $this->amount, 2);

                    break;
                
                case 'inclusive':

                     $this->data['net_amount'] = number_format( $this->amount * (100 / (100 + $this->rate)), 2);

                     $this->data['gst_amount'] = number_format( $this->amount - ($this->amount * (100 / (100 + $this->rate))), 2);

                     $this->data['gross_amount'] = number_format($this->amount, 2);

                    break;
            }

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'GST Calculator';
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
        $this->amount = 100000;
        $this->rate   = 6;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->amount = null;
        $this->rate   = null;
        $this->data   = null;
    }
}
