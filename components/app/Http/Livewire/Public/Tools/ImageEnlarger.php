<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DateTime, File;
use App\Models\Admin\General;
use Image;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;

class ImageEnlarger extends Component
{

    protected $listeners = ['onImageCropper', 'onSetPercentage', 'onSetImageWidthHeight'];
    public $convertType = 'localPhoto';
    public $remote_url;
    public $percentage = 0;
    public $imageWidth; 
    public $imageHeight; 
    public $imageWidthFinal;
    public $imageHeightFinal;
    public $imageData;
    public $recaptcha;

    public function mount()
    {
        $this->imageWidth  = Image::make( asset('assets/img/preview-image.jpg') )->width();
        $this->imageHeight = Image::make( asset('assets/img/preview-image.jpg') )->height();
        $this->imageData   = asset('assets/img/preview-image.jpg');
    }

    public function render()
    {
        return view('livewire.public.tools.image-enlarger');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onConvertType
     * -------------------------------------------------------------------------------
    **/
    public function onConvertType( $type ){
        $this->convertType = $type;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetImageWidthHeight
     * -------------------------------------------------------------------------------
    **/
    public function onSetImageWidthHeight( $data ){
        $this->imageWidth       = Image::make( $data )->width();
        $this->imageHeight      = Image::make( $data )->height();
        $this->imageWidthFinal  = $this->imageWidth;
        $this->imageHeightFinal = $this->imageHeight;
        $this->imageData        = $data;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetPercentage
     * -------------------------------------------------------------------------------
    **/
    public function onSetPercentage($value)
    {
        $this->percentage       = $value;
        $this->imageWidthFinal  = round( $this->imageWidth * $value / 100 );
        $this->imageHeightFinal = round( $this->imageHeight * $value / 100 );
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAddRemoteURL
     * -------------------------------------------------------------------------------
    **/
    public function onAddRemoteURL()
    {

        $this->validate([
            'remote_url' => 'required|url'
        ]);
        
        try {

            $fileName     = pathinfo($this->remote_url, PATHINFO_BASENAME);

            $fileNameTemp = time() . '.' . pathinfo( $this->remote_url, PATHINFO_EXTENSION);

            Storage::disk('local')->put('livewire-tmp/' . $fileNameTemp, Http::get($this->remote_url) );
            
            $temp_url     = asset('components/storage/app/livewire-tmp/' . $fileNameTemp);

            $fileType     = File::mimeType( storage_path('app/livewire-tmp/') . $fileNameTemp );

            $this->dispatchBrowserEvent('onSetRemoteURL', ['url' => $temp_url, 'fileName' => $fileName, 'fileType' => $fileType ]);

            $this->onSetImageWidthHeight($temp_url);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  onImageEnlarger
     * -------------------------------------------------------------------------------
    **/
    public function onImageEnlarger(){

        $validationRules = [];
        
        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }

        try {

                if (preg_match('/^data:image\/(\w+);base64,/', $this->imageData)) {

                    $imageType = explode('/', mime_content_type($this->imageData))[1];

                    if( $imageType == 'jpeg' ) $imageType = 'jpg';
                    
                    $fileName = time() . '.' . $imageType;

                    $base64_data = substr($this->imageData, strpos($this->imageData, ',') + 1);

                    $base64_data = base64_decode($base64_data);

                    Storage::disk('local')->put('livewire-tmp/' . $fileName, $base64_data);

                    $imageLink = asset('components/storage/app/livewire-tmp/' . $fileName);

                } else $imageLink = $this->imageData;

                $img = Image::make( $imageLink );

                $img->resize($this->imageWidthFinal, $this->imageHeightFinal);

                $fileName = time() . '.' . pathinfo( $imageLink, PATHINFO_EXTENSION);

                $img->save( storage_path('app/livewire-tmp/') . $fileName );

                $url  = asset('components/storage/app/livewire-tmp/' . $fileName);

                $data['url']      = $url;
                $data['filename'] = General::orderBy('id', 'DESC')->first()->prefix . time();
                $data['type']     = pathinfo( $imageLink, PATHINFO_EXTENSION);
                $dlLink           = url('/') . '/dl.php?token=' . $this->encode( json_encode($data) );

                $this->dispatchBrowserEvent('showModal', ['id' => 'modalPreviewDownloadImage', 'preview' => $url, 'download' => $dlLink ]);

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Image Enlarger';
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
     *  encode
     * -------------------------------------------------------------------------------
    **/
    function encode($pData)
    {
        $encryption_key = 'themeluxurydotcom';

        $encryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
          
        $encryption = openssl_encrypt($pData, $ciphering, $encryption_key, 0, $encryption_iv);

        return $encryption;
    }
    
}
