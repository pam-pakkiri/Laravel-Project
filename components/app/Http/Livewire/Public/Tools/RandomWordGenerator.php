<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RandomWordGeneratorClass;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class RandomWordGenerator extends Component
{
    protected $listeners = ['onSetInList', 'onClearInList'];
    public $word_type    = 'all_words';
    public $number       = 5;
    public $data         = [];
    public $temp_data    = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.random-word-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetInList
     * -------------------------------------------------------------------------------
    **/
    public function onSetInList($value)
    {
        array_push($this->data, $value);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onClearInList
     * -------------------------------------------------------------------------------
    **/
    public function onClearInList()
    {
        $this->data = [];
    }

    /**
     * -------------------------------------------------------------------------------
     *  onRandomWordGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onRandomWordGenerator(){

        $validationRules = [
            'number' => 'required|integer|min:1|max:1000'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->temp_data = null;

        try {

            $output = new RandomWordGeneratorClass();

            $this->temp_data = $output->get_data( $this->word_type, $this->number );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->temp_data) ) {

            $history             = new History;
            $history->tool_name  = 'Random Word Generator';
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
