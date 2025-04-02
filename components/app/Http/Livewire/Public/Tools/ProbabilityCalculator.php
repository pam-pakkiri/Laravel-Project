<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class ProbabilityCalculator extends Component
{

    public $outcomes;
    public $events_occured;
    public $recaptcha;
    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.probability-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onProbabilityCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onProbabilityCalculator(){

        $validationRules = [
            'outcomes'       => 'required|numeric',
            'events_occured' => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $occurs                   = (($this->events_occured / $this->outcomes ) * 1000 ) / 1000;

            $this->data['occurs']     = number_format($occurs, 2);

            $this->data['not_occurs'] = number_format(((1 - $occurs) * 1000) / 1000, 2);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Probability Calculator';
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
        $this->outcomes       = 9;
        $this->events_occured = 3;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->outcomes       = null;
        $this->events_occured = null;
		$this->data = null;
    }
}
