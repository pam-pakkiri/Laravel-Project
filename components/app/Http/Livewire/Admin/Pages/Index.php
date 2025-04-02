<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\Languages;
use Illuminate\Support\Facades\DB;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{
	
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $searchQuery = '';
    protected $listeners = ['onDeletePage', 'sendUpdatePageStatus' => 'onUpdatePageStatus'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        //Meta
        $title = __('Pages') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.pages.index', [
            'default_lang'         => Languages::where('default', true)->first()->code,
            'pages'                => Page::where('slug', 'like', '%'.$this->searchQuery.'%')->whereIn('type', ['page', 'home', 'contact', 'report'])->orderBy('id', 'DESC')->paginate(15),
            'total_lang'           => DB::table('languages')->count(),
            'translation_progress' => PageTranslation::select( 'page_id', DB::raw('count(*) as progress') )->groupBy('page_id')->get()->toArray()
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Pages' ), 'url' => route('admin.pages.index')]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdatePageStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdatePageStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditPageModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditPageModal($id)
    {
        $page        = Page::findOrFail($id);
        $this->emit('sendDataEditPage', ['id' => $page->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editPage']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAds
     * -------------------------------------------------------------------------------
    **/
    public function onAds($id, $adsStatus)
    {
        // Get the page by ID or throw an exception if not found
        $page = Page::findOrFail($id);

        // Toggle the popular status
        $page->ads_status = !$adsStatus;

        // Save the changes
        $page->save();
    }
    
    /**
     * -------------------------------------------------------------------------------
     *  onEnablePage
     * -------------------------------------------------------------------------------
    **/
    public function onEnablePage($id)
    {
        try {

            $post              = Page::findOrFail($id);
            $post->post_status = true;
            $post->updated_at  = new DateTime();
            $post->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            $this->mount();
            
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

            $post              = Page::findOrFail($id);
            $post->post_status = false;
            $post->updated_at  = new DateTime();
            $post->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmPage
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmPage($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeletePage
     * -------------------------------------------------------------------------------
    **/
    public function onDeletePage($id)
    {
        try {
            $page = Page::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
