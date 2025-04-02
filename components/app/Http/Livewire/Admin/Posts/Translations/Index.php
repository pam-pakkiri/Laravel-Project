<?php

namespace App\Http\Livewire\Admin\Posts\Translations;

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
    protected $listeners       = ['onDeletePostTranslation'];

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
        $title = __('Post Translations') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.posts.translations.index', [
            'page_translations' => PageTranslation::where('page_id', $this->page_id)->where('title', 'like', '%'.$this->searchQuery.'%')->orderBy('id', 'DESC')->paginate(15),
            'page_id'           => $this->page_id,
            'slug'              => ( Page::where('id', $this->page_id)->first()->type != 'home' ) ? Page::where('id', $this->page_id)->first()->slug : '',
            'type'              => ( Page::where('id', $this->page_id)->first()->type != 'home' ) ? Page::where('id', $this->page_id)->first()->type : ''
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Posts' ), 'url' => route('admin.posts.index')],
                ['title' => __( 'Translations' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmPostTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmPostTranslation($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeletePostTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onDeletePostTranslation($id)
    {
        try {

            $post = PageTranslation::findOrFail($id);

            $post->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }


    }

}
