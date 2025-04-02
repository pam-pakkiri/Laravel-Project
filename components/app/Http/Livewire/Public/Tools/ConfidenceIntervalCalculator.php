<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class ConfidenceIntervalCalculator extends Component
{
    public $sample_mean;
    public $sample_size;
    public $standrad_devation;
    public $confidence_level;
    public $recaptcha;

    public $data = [];

    public function render()
    {
        return view('livewire.public.tools.confidence-interval-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onConfidenceIntervalCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onConfidenceIntervalCalculator(){

        $validationRules = [
            'sample_mean'       => 'required|numeric',
            'sample_size'       => 'required|numeric',
            'standrad_devation' => 'required|numeric',
            'confidence_level'  => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            switch ($this->confidence_level) {

                case 99.9:
                     $z = 3.291;
                    break;

                case 99.5:
                     $z = 2.807;
                    break;

                case 99:
                     $z = 2.576;
                    break;

                case 95:
                     $z = 1.960;
                    break;

                case 90:
                     $z = 1.645;
                    break;

                case 85:
                     $z = 1.440;
                    break;

                case 80:
                     $z = 1.282;
                    break;

                case 75:
                     $z = 1.150;
                    break;

                case 70:
                     $z = 1.036;
                    break;

                default:
                        $z = 3.291;
                    break;
            }
			
            $this->data['lower'] = round($this->sample_mean - $z * $this->standrad_devation / sqrt($this->sample_size), 2);

            $this->data['upper'] = round($this->sample_mean + $z * $this->standrad_devation / sqrt($this->sample_size), 2);

            $this->data['margin'] = round(($this->sample_mean + $z * $this->standrad_devation / sqrt($this->sample_size)) - $this->sample_mean, 2);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Confidence Interval Calculator';
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
        $this->sample_mean       = 10;
        $this->sample_size       = 5;
        $this->standrad_devation = 10;
        $this->confidence_level  = 99.9;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->sample_mean       = null;
        $this->sample_size       = null;
        $this->standrad_devation = null;
        $this->confidence_level  = null;
        $this->data              = null;
    }
}
