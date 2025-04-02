<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Admin\AuthPages as AuthenticationPages;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class AuthPages extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public function render()
    {
        //Meta
        $title = __('Authentication Pages') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.pages.auth-pages', [
            'auth_pages'                => AuthenticationPages::orderBy('id', 'DESC')->paginate(15),
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Pages' ), 'url' => route('admin.pages.index')],
                ['title' => __( 'Authentication' ), 'url' => route('admin.pages.authentication.index')]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEnablePage
     * -------------------------------------------------------------------------------
    **/
    public function onEnablePage($id)
    {
        try {

            $page             = AuthenticationPages::findOrFail($id);
            $page->status     = true;
            $page->updated_at = new DateTime();
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDisablePage
     * -------------------------------------------------------------------------------
    **/
    public function onDisablePage($id)
    {
        try {

            $page             = AuthenticationPages::findOrFail($id);
            $page->status     = false;
            $page->updated_at = new DateTime();
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
