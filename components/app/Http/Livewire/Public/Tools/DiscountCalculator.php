<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class DiscountCalculator extends Component
{

    public $price;
    public $discount;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.discount-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDiscountCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onDiscountCalculator(){

        $validationRules = [
            'price'    => 'required|numeric',
            'discount' => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $saving                         = $this->price * $this->discount / 100;

            $this->data['saving']           =  number_format($saving, 2);

            $this->data['discounted_price'] =  number_format($this->price - $saving, 2);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Discount Calculator';
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
        $this->price    = 59;
        $this->discount = 15;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->price    = null;
        $this->discount = null;
        $this->data     = null;
    }
}
