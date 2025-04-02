<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\AgeCalculatorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use Carbon\Carbon;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class AgeCalculator extends Component
{

    public $byear;
    public $bmonth;
    public $bday;

    public $year;
    public $month;
    public $day;

    public $data = [];

    public $recaptcha;

    public function mount()
    {
        $now = Carbon::now();

        $this->byear = $now->year;
        $this->bmonth = $now->month;
        $this->bday = $now->day;

        $this->year = $now->year;
        $this->month = $now->month;
        $this->day = $now->day;
    }

    public function render()
    {
        return view('livewire.public.tools.age-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAgeCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onAgeCalculator(){

        $validationRules = [
            'byear'  => 'required|numeric|gt:0',
            'bmonth' => 'required|numeric|gt:0',
            'bday'   => 'required|numeric|gt:0',
            'year'   => 'required|numeric|gt:0',
            'month'  => 'required|numeric|gt:0',
            'day'    => 'required|numeric|gt:0'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new AgeCalculatorClass();

            $this->data = $output->get_data( $this->byear, $this->bmonth, $this->bday, $this->year, $this->month, $this->day );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Age Calculator';
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
