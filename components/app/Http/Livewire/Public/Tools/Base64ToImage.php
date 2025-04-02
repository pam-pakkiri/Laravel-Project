<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\Base64ToImageClass;
use Illuminate\Support\Facades\Storage;
use DateTime, File;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class Base64ToImage extends Component
{
    public $base64_string;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.base64-to-image');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onBase64ToImage
     * -------------------------------------------------------------------------------
    **/
    public function onBase64ToImage(){

        $validationRules = [
            'base64_string' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new Base64ToImageClass();
            
            $this->data = $output->get_data( $this->base64_string );

            if ( !empty($this->data) ) {
                $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'preview' => $this->data['preview'], 'download' => $this->data['download'] ]);
            }

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Base64 To Image';
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
