<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class LoanCalculator extends Component
{
    public $amount;
    public $months;
    public $rate;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.loan-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onLoanCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onLoanCalculator(){

        $validationRules = [
            'amount' => 'required|numeric',
            'months' => 'required|numeric',
            'rate'   => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $monthly_interest_rate      = ($this->rate / 1200);

                $monthly_payments           = ($this->amount * $monthly_interest_rate) / (1 - 1 / pow(1 + $monthly_interest_rate, $this->months));
                
                $total_cost_of_loan         = $monthly_payments * $this->months;

                $total_interest             = $total_cost_of_loan - $this->amount;

                $this->data['monthly_payments']   = number_format($monthly_payments, 2);

                $this->data['total_cost_of_loan'] = number_format($total_cost_of_loan, 2);

                $this->data['total_interest']     = number_format($total_interest, 2);

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Loan Calculator';
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
        $this->months  = 12;
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
        $this->months = null;
        $this->rate   = null;
        $this->data   = null;
    }
}
