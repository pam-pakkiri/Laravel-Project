<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Gdpr as Gdprs;
use GrahamCampbell\Security\Facades\Security;
use Artesaos\SEOTools\Facades\SEOMeta;

class Gdpr extends Component
{
	public $notice;
    public $align;
    public $background;
    public $button;
	public $status;

    public function mount()
    {
        $notice           = Gdprs::findOrFail(1);
        $this->notice     = $notice->notice;
        $this->align      = $notice->align;
        $this->background = $notice->background;
        $this->button     = $notice->button;
        $this->status     = $notice->status;
    }

    public function render()
    {

        //Meta
        $title = __('GDPR') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.gdpr')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'GDPR Cookies' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateNotice
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateNotice()
    {
        try {

            $notice             = Gdprs::findOrFail(1);
            $notice->notice     = Security::clean( $this->notice );
            $notice->align      = $this->align;
            $notice->background = $this->background;
            $notice->button     = $this->button;
            $notice->status     = $this->status;
            $notice->updated_at = new DateTime();
            $notice->save();

            $this->mount();
            $this->render();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
