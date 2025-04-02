<?php

namespace App\Http\Livewire\Admin\Settings\Redirects;

use Livewire\Component;
use App\Models\Admin\Redirect;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $searchQuery = '';
    protected $listeners = ['onDeleteRedirect', 'sendUpdateRedirectStatus' => 'onUpdateRedirectStatus'];

    public function render()
    {

        //Meta
        $title = __('Redirects') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.redirects.index', [
            'redirects' => Redirect::orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Redirects' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateRedirectStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateRedirectStatus(){
        $this->mount();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditRedirectModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditRedirectModal($id)
    {
        $this->emit('sendDataEditRedirect', ['id' => $id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editRedirect']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmRedirect
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmRedirect($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteRedirect
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteRedirect($id)
    {
        try {
            $page = Redirect::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
            $this->render();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
