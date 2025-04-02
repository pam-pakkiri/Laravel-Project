<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class CsvToJson extends Component
{

    public $csv;
    public $data;
    public $recaptcha;
    public function render()
    {
        return view('livewire.public.tools.csv-to-json');
    }

    /**
     * -------------------------------------------------------------------------------
     *  csvToJson
     * -------------------------------------------------------------------------------
    **/
    private function csvToJson($data) {
        
          $array = array_map("str_getcsv", explode("\n", $data));

          $labels = array_shift($array);

          foreach($labels as $label)
          {
            $column_name[] = $label;
          }

          $count = count($array) - 1;

          for($j = 0; $j < $count; $j++)
          {
            $data = array_combine($column_name, $array[$j]);

            $result[$j] = $data;
          }

          return json_encode($result);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCsvToJson
     * -------------------------------------------------------------------------------
    **/
    public function onCsvToJson(){

        $validationRules = [
            'csv' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $this->data = $this->csvToJson($this->csv);

            $this->dispatchBrowserEvent('resetReCaptcha');
            
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'CSV to JSON';
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
        $this->csv = 'album, year
The White Stripes, 1999
De Stijl, 2000
White Blood Cells, 2001';
        
        $this->data = null;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->csv = '';
        $this->data = null;
    }
}

