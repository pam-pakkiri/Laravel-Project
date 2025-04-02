<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class PercentageCalculator extends Component
{

    public $percentage;
    public $percentageOf;
    public $percentageResult;

    public $percentageIs;
    public $percentageWhat;
    public $percentageWhatResult;

    public $isPercentage;
    public $isPercentageOf;
    public $isPercentageOfResult;

    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.percentage-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPercentageCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onPercentageCalculator(){

        $validationRules = [
            'percentage'   => 'required|numeric',
            'percentageOf' => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

            $this->percentageResult = $this->percentage * $this->percentageOf / 100;

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Percentage Calculator';
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

    /**
     * -------------------------------------------------------------------------------
     *  onPercentageWhatCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onPercentageWhatCalculator(){

        $this->validate([
            'percentageIs'   => 'required|numeric',
            'percentageWhat' => 'required|numeric'
        ]);

        try {

            $this->percentageWhatResult = round( $this->percentageIs / $this->percentageWhat * 100, 2) . '%';
            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Percentage Calculator';
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

    /**
     * -------------------------------------------------------------------------------
     *  onIsPercentageOfCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onIsPercentageOfCalculator(){

        $this->validate([
            'isPercentage'   => 'required|numeric',
            'isPercentageOf' => 'required|numeric'
        ]);

        try {

            $this->isPercentageOfResult = round( $this->isPercentage / $this->isPercentageOf * 100, 2);
            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Percentage Calculator';
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
