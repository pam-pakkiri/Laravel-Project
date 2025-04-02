<?php

namespace App\Http\Livewire\Admin\Pages\Translations;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $page_id;
    public $searchQuery        = '';
    protected $listeners       = ['onDeletePageTranslation'];

    public function updatingSearch()
    {
        $this->resetPage();
	}

    public function mount($page_id)
    {
        $this->page_id = $page_id;
    }

    public function render()
    {

        //Meta
        $title = __('Page Translations') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.pages.translations.index', [
            'page_translations' => PageTranslation::where('page_id', $this->page_id)->where('title', 'like', '%'.$this->searchQuery.'%')->orderBy('id', 'DESC')->paginate(15),
            'page_id'           => $this->page_id,
            'slug'              => ( Page::where('id', $this->page_id)->first()->type != 'home' ) ? Page::where('id', $this->page_id)->first()->slug : '',
            'type'              => ( Page::where('id', $this->page_id)->first()->type != 'home' ) ? Page::where('id', $this->page_id)->first()->type : ''
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Pages' ), 'url' => route('admin.pages.index')],
                ['title' => __( 'Translations' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmPageTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmPageTranslation($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeletePageTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onDeletePageTranslation($id)
    {
        try {

            $page = PageTranslation::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }


    }

}
