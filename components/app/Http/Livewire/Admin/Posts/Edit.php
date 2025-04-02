<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use GrahamCampbell\Security\Facades\Security;

class Edit extends Component
{
    public $page_id;
    public $slug;
    public $featured_image;

    protected $listeners = ['onSetFeaturedImage', 'sendDataEditPost' => 'onDataEditPost'];

    public function render()
    {
        return view('livewire.admin.posts.edit')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDataEditPost
     * -------------------------------------------------------------------------------
    **/
    public function onDataEditPost(Page $page)
    {
        $this->page_id        = $page->id;
        $this->slug           = $page->slug;
        $this->featured_image = $page->featured_image;
        $this->target         = $page->target;
    }

    /**
     * -------------------------------------------------------------------------------
     *  createSlug
     * -------------------------------------------------------------------------------
    **/
    public function createSlug()
    {
        $this->slug = SlugService::createSlug(Page::class, 'slug', $this->slug);
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['page_id', 'slug', 'featured_image']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetFeaturedImage
     * -------------------------------------------------------------------------------
    **/
    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEditPost
     * -------------------------------------------------------------------------------
    **/
    public function onEditPost($id)
    {
        $this->validate([
            'slug'  => 'required',
        ]);

        try {

            $page                 = Page::findOrFail($id);
            $page->slug           = SlugService::createSlug(Page::class, 'slug', $this->slug);
            $page->type           = 'post';
            $page->featured_image = strip_tags($this->featured_image);
            $page->target         = Security::clean( strip_tags($this->target) );
            $page->updated_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editPost']);
            $this->resetInputFields();
            $this->emit('sendUpdatePostStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
