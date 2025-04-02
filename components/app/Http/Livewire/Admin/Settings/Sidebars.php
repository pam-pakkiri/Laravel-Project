<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\Sidebar as SB;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;

class Sidebars extends Component
{
    public $post_status;
    public $post_sticky;
    public $post_count;
    public $post_align;
    public $post_background;
    public $tool_status;
    public $tool_sticky;
    public $tool_count;
    public $tool_align;
    public $tool_background;
    public $pages = [];

    public function mount()
    {
        $this->pages           = Page::where('type', 'tool')->orderBy('id', 'DESC')->get()->toArray();

        $sidebar               = SB::findOrFail(1);
        $this->post_status     = $sidebar->post_status;
        $this->post_sticky     = $sidebar->post_sticky;
        $this->post_count      = $sidebar->post_count;
        $this->post_align      = $sidebar->post_align;
        $this->post_background = $sidebar->post_background;
        $this->tool_status     = $sidebar->tool_status;
        $this->tool_sticky     = $sidebar->tool_sticky;
        $this->tool_count      = $sidebar->tool_count;
        $this->tool_align      = $sidebar->tool_align;
        $this->tool_background = $sidebar->tool_background;

    }

    public function render()
    {

        //Meta
        $title = __('Sidebars') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.sidebars')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Sidebars' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateSidebars
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateSidebars()
    {
        try {

            $sidebar                  = SB::findOrFail(1);
            $sidebar->tool_status     = $this->tool_status;
            $sidebar->post_sticky     = $this->post_sticky;
            $sidebar->tool_count      = $this->tool_count;
            $sidebar->tool_align      = $this->tool_align;
            $sidebar->tool_background = $this->tool_background;
            $sidebar->post_status     = $this->post_status;
            $sidebar->tool_sticky     = $this->tool_sticky;
            $sidebar->post_count      = $this->post_count;
            $sidebar->post_align      = $this->post_align;
            $sidebar->post_background = $this->post_background;

            $sidebar->updated_at   = new DateTime();
            $sidebar->save();

            $this->mount();
            $this->render();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
