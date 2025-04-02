<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class MarginCalculator extends Component
{

    public $type = 'profit';
    public $cost;
    public $gross_margin;

    public $stock_price;
    public $number_of_shares;
    public $margin_requirement;

    public $exchange_rate;
    public $margin_ratio = 20;
    public $units;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.margin-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  getValidationRulesByType
     * -------------------------------------------------------------------------------
    **/
    public function getValidationRulesByType()
    {
        $rules = [
            'profit' => [
                'cost'         => 'required|numeric',
                'gross_margin' => 'required|numeric',
            ],
            'stock' => [
                'stock_price'        => 'required|numeric',
                'number_of_shares'   => 'required|numeric',
                'margin_requirement' => 'required|numeric',
            ],
            'currency' => [
                'exchange_rate' => 'required|numeric',
                'margin_ratio'  => 'required|numeric',
                'units'         => 'required|numeric',
            ],
        ];

        return $rules[$this->type] ?? $rules['profit'];
    }

    /**
     * -------------------------------------------------------------------------------
     *  onMarginCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onMarginCalculator(){

        $validationRules = $this->getValidationRulesByType();

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                switch ($this->type) {

                    case 'profit':

                            $percent = (100 - $this->gross_margin) / 100;

                            $this->data['profit']['sale_revenue'] = number_format($this->cost / $percent, 2);
                            $this->data['profit']['gross_profit'] = number_format($this->cost / $percent - $this->cost, 2);
                            $this->data['profit']['mark_up'] = number_format(100 * ($this->cost / $percent - $this->cost) / $this->cost, 2);

                        break;

                    case 'stock':

                            $amount = $this->number_of_shares * $this->stock_price * $this->margin_requirement / 100;

                            $this->data['amount_required'] = number_format($amount, 2);

                        break;

                    case 'currency':

                            $amount = $this->exchange_rate * $this->units / $this->margin_ratio;

                            $this->data['amount_required'] = number_format($amount, 2);

                        break;

                    default:

                            $percent = (100 - $this->gross_margin) / 100;

                            $this->data['profit']['sale_revenue'] = number_format($this->cost / $percent, 2);
                            $this->data['profit']['gross_profit'] = number_format($this->cost / $percent - $this->cost, 2);
                            $this->data['profit']['mark_up'] = number_format(100 * ($this->cost / $percent - $this->cost) / $this->cost, 2);

                        break;
                }

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Margin Calculator';
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
        $this->type               = 'profit';
        $this->cost               = 100;
        $this->gross_margin       = 5;

        $this->stock_price        = 18;
        $this->number_of_shares   = 100;
        $this->margin_requirement = 30;

        $this->exchange_rate      = 1.5;
        $this->margin_ratio       = 20;
        $this->units              = 100;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->cost               = null;
        $this->gross_margin       = null;
        $this->stock_price        = null;
        $this->number_of_shares   = null;
        $this->margin_requirement = null;
        $this->exchange_rate      = null;
        $this->margin_ratio       = null;
        $this->units              = null;
        $this->data               = null;
    }
}
