<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class AverageCalculator extends Component
{

    public $link;
    public $data          = [];
    public $inputs        = [];
    public $numbers       = [];
    public $i             = 2;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.average-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAddNumber
     * -------------------------------------------------------------------------------
    **/
    public function onAddNumber($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteNumber
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteNumber($k, $v)
    {
        unset($this->inputs[$k]);
        unset($this->numbers[$v]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  median
     * -------------------------------------------------------------------------------
    **/
    private function median(array $arr)
    {
        if (0 === count($arr)) {
            return null;
        }

        // sort the data
        $count = count($arr);
        asort($arr);

        // get the mid-point keys (1 or 2 of them)
        $mid  = floor(($count - 1) / 2);
        $keys = array_slice(array_keys($arr), $mid, (1 === $count % 2 ? 1 : 2));
        $sum  = 0;
        foreach ($keys as $key) {
            $sum += $arr[$key];
        }
        return $sum / count($keys);
    }

    /**
     * -------------------------------------------------------------------------------
     *  geometric
     * -------------------------------------------------------------------------------
    **/
    private function geometric($arr) {  

       foreach($arr as $i=>$n) $mul = $i == 0 ? $n : $mul*$n;  

       return pow($mul,1/count($arr));  
    }

    /**
     * -------------------------------------------------------------------------------
     *  harmonic
     * -------------------------------------------------------------------------------
    **/
    function harmonic($arr, $n)
    {
         
        // Declare sum variables and
        // initialize with zero
        $sum = 0;
        for ($i = 0; $i < $n; $i++)
            $sum = $sum + (float)
                   (1 / $arr[$i]);
     
        return (float)($n / $sum);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAverageCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onAverageCalculator(){

        $validationRules = [
            'numbers.0' => 'required|numeric',
            'numbers.1' => 'required|numeric'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

            $arr = array();

            if ( $this->numbers != null) {

                foreach ($this->numbers as $key => $value) {

                    array_push( $arr, $value );
                }

            }

            $this->data['average'] = array_sum($arr) / count($arr);

            $this->data['sum'] = array_sum($arr);

            $this->data['count'] = count($arr);

            $this->data['median'] = $this->median($arr);

            $this->data['geometric'] =  number_format($this->geometric($arr), 4);

            $this->data['largest'] = max($arr);

            $this->data['smallest'] = min($arr);

            $this->data['harmonic'] = number_format( $this->harmonic($arr, sizeof($arr) ), 4);

            $this->data['range'] = max($arr) - min($arr);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Average Calculator';
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
