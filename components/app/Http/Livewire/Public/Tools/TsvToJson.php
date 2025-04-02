<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class TsvToJson extends Component
{

    public $tsv;
    public $data;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.tsv-to-json');
    }

    /**
     * -------------------------------------------------------------------------------
     *  tsvToJson
     * -------------------------------------------------------------------------------
    **/
    private function tsvToJson($data) {
        
          $data = trim(str_replace("\t", ",", $data));
     
          $array = array_map("str_getcsv", explode("\n", $data));

          $labels = array_shift($array);

          foreach($labels as $label)
          {

            $column_name[] = $label;

          }

          $count = count($array);

          for($j = 0; $j < $count; $j++)
          {
            $data = array_combine($column_name, $array[$j]);

            $result[$j] = $data;
          }

          return json_encode($result);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onTsvToJson
     * -------------------------------------------------------------------------------
    **/
    public function onTsvToJson(){

        $validationRules = [
            'tsv' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $this->data = $this->tsvToJson($this->tsv);
            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'TSV to JSON';
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
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->tsv = 'Album' . chr(9) . 'Year' . PHP_EOL;
        $this->tsv .= 'The White Stripes' . chr(9) . '1999' . PHP_EOL;
        $this->tsv .= 'De Stijl'  . chr(9) . '2000' . PHP_EOL;
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->tsv = '';
        $this->data = null;
    }
}
