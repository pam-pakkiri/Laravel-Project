<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use GrahamCampbell\Security\Facades\Security;

class Create extends Component
{
    public $slug;
    public $featured_image;
    public $target = '_self';

    protected $listeners = ['onSetFeaturedImage'];

    public function render()
    {
        return view('livewire.admin.posts.create')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['slug', 'featured_image']);
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
     *  onSetFeaturedImage
     * -------------------------------------------------------------------------------
    **/
    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCreatePost
     * -------------------------------------------------------------------------------
    **/
    public function onCreatePost()
    {

        $this->validate([
            'slug'  => 'required|unique:pages',
        ]);

        try {

            $page                 = new Page;
            $page->slug           = SlugService::createSlug(Page::class, 'slug', $this->slug);
            $page->type           = 'post';
            $page->featured_image = strip_tags($this->featured_image);
            $page->target         = Security::clean( strip_tags($this->target) );
            $page->created_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewPost']);
            $this->resetInputFields();
            $this->emit('sendUpdatePostStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
