<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Models\Admin\General;

class Captcha extends Component
{
    public $status;
    public $site_key;
    public $secret_key;

    public function mount()
    {
        $general          = General::findOrFail(1);
        $this->status     = $general->captcha_status;
        $this->site_key   = env("GOOGLE_RECAPTCHA_SITE_KEY");
        $this->secret_key = env("GOOGLE_RECAPTCHA_SECRET_KEY");
    }

    public function render()
    {

        //Meta
        $title = __('Captcha') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.captcha')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Captcha' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateCaptcha
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateCaptcha()
    {
        try {

            $env = new DotenvEditor();

            $env->changeEnv([
                'GOOGLE_RECAPTCHA_SITE_KEY'   => "'$this->site_key'",
                'GOOGLE_RECAPTCHA_SECRET_KEY' =>  "'$this->secret_key'"
            ]);

            $general                 = General::findOrFail(1);
            $general->captcha_status = $this->status;
            $general->updated_at     = new DateTime();
            $general->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }
}
