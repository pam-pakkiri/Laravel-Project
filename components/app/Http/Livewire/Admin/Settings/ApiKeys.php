<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\ApiKeys as ApiKey;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;

class ApiKeys extends Component
{

    public $facebook_cookies;
    public $indexnow_api_key;
    public $moz_access_id;
    public $moz_secret_key;
    public $google_api_key;

    public function mount()
    {
        $api_key                = ApiKey::findOrFail(1);
        $this->facebook_cookies = $api_key->facebook_cookies;
        $this->moz_access_id    = $api_key->moz_access_id;
        $this->moz_secret_key   = $api_key->moz_secret_key;
        $this->indexnow_api_key = $api_key->indexnow_api_key;
        $this->google_api_key   = $api_key->google_api_key;
    }

    public function render()
    {

        //Meta
        $title = __('API Keys') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.api-keys')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'API Keys' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  generateAPIKey
     * -------------------------------------------------------------------------------
    **/
    public function generateAPIKey() {
        $api_key = (string) Str::uuid();
        $api_key = preg_replace('[-]', '', $api_key);

        return $api_key;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onIndexNowAPIKey
     * -------------------------------------------------------------------------------
    **/
    public function onIndexNowAPIKey()
    {
        try {

            $api_key                   = ApiKey::findOrFail(1);
            $api_key->indexnow_api_key = $this->generateAPIKey();
            $api_key->updated_at       = new DateTime();
            $api_key->save();
            
            $this->mount();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateAPIKeys
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateAPIKeys()
    {
        try {

            $api_key                   = ApiKey::findOrFail(1);
            $api_key->facebook_cookies = $this->facebook_cookies;
            $api_key->moz_access_id    = $this->moz_access_id;
            $api_key->moz_secret_key   = $this->moz_secret_key;
            $api_key->google_api_key   = $this->google_api_key;
            $api_key->updated_at       = new DateTime();
            $api_key->save();
            $this->mount();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
