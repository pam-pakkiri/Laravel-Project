<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class PaypalFeeCalculator extends Component
{

    public $amount;
    //public $country = 'USA';
    public $fee = '2.9||.30';
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.paypal-fee-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPaypalFeeCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onPaypalFeeCalculator(){

        $validationRules = [
            'amount'  => 'required|numeric',
            //'country' => 'required',
            'fee'     => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $exFee                     = explode('||', $this->fee);

            $total_fee                 = $this->amount * $exFee[0] / 100 + $exFee[1];

            $this->data['total_fee']   = number_format($total_fee, 2);

            $this->data['recieve_fee'] =  number_format($this->amount - $total_fee, 2);

            $this->data['ask_for']     = number_format($this->amount + $total_fee, 2);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Paypal Fee Calculator';
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
        $this->amount  = 100;
        //$this->country = 'USA';
        $this->fee     = '2.9||.30';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->data = null;
        $this->amount  = null;
        //$this->country = null;
        $this->fee     = '2.9||.30';
    }
}
