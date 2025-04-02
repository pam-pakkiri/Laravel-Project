<?php

namespace App\Http\Livewire\Admin\Posts;

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
    protected $listeners = ['onDeletePost', 'sendUpdatePostStatus' => 'onUpdatePostStatus'];

    public function render()
    {

        //Meta
        $title = __('Post Translations') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.posts.index', [
            'default_lang'         => Languages::where('default', true)->first()->code,
            'posts'                => Page::where('slug', 'like', '%'.$this->searchQuery.'%')->whereIn('type', ['post'])->orderBy('id', 'DESC')->paginate(15),
            'total_lang'           => DB::table('languages')->count(),
            'translation_progress' => PageTranslation::select( 'page_id', DB::raw('count(*) as progress') )->groupBy('page_id')->get()->toArray()
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Posts' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  updatingSearch
     * -------------------------------------------------------------------------------
    **/
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdatePostStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdatePostStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditPostModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditPostModal($id)
    {
        $post        = Page::findOrFail($id);
        $this->emit('sendDataEditPost', ['id' => $post->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editPost']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAds
     * -------------------------------------------------------------------------------
    **/
    public function onAds($id, $adsStatus)
    {
        // Get the post by ID or throw an exception if not found
        $post = Page::findOrFail($id);

        // Toggle the popular status
        $post->ads_status = !$adsStatus;

        // Save the changes
        $post->save();
    }
    
    /**
     * -------------------------------------------------------------------------------
     *  onEnablePost
     * -------------------------------------------------------------------------------
    **/
    public function onEnablePost($id)
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
     *  onDisablePost
     * -------------------------------------------------------------------------------
    **/
    public function onDisablePost($id)
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
     *  onDeleteConfirmPost
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmPost($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeletePost
     * -------------------------------------------------------------------------------
    **/
    public function onDeletePost($id)
    {
        try {
            $post = Page::findOrFail($id);

            $post->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
