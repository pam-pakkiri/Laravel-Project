<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Models\Admin\SocialLogin as Social;
use App\Models\Admin\General;

class SocialLogin extends Component
{

    public $google_login_status;
    public $google_client_id;
    public $google_client_secret;

    public $facebook_login_status;
    public $facebook_client_id;
    public $facebook_client_secret;

    public function mount()
    {
        $social                       = General::findOrFail(1);
        $this->google_login_status    = $social->google_login_status;
        $this->facebook_login_status  = $social->facebook_login_status;
        $this->google_client_id       = env("GOOGLE_CLIENT_ID");
        $this->google_client_secret   = env("GOOGLE_CLIENT_SECRET");
        $this->facebook_client_id     = env("FACEBOOK_CLIENT_ID");
        $this->facebook_client_secret = env("FACEBOOK_CLIENT_SECRET");
    }

    public function render()
    {
        //Meta
        $title = __('Social Login') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.social-login')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Social Login' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateSocialLogin
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateSocialLogin()
    {
        try {

            $env = new DotenvEditor();

            $env->changeEnv([
                'GOOGLE_CLIENT_ID'       => "'$this->google_client_id'",
                'GOOGLE_CLIENT_SECRET'   => "'$this->google_client_secret'",
                'FACEBOOK_CLIENT_ID'     => "'$this->facebook_client_id'",
                'FACEBOOK_CLIENT_SECRET' => "'$this->facebook_client_secret'"
            ]);

            $social                        = General::findOrFail(1);
            $social->google_login_status   = $this->google_login_status;
            $social->facebook_login_status = $this->facebook_login_status;
            $social->updated_at            = new DateTime();
            $social->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
