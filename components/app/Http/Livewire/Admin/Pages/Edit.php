<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Edit extends Component
{
    public $page_id;
    public $slug;
    public $featured_image;
    public $type;
    
    protected $listeners = ['onSetFeaturedImage', 'sendDataEditPage' => 'onDataEditPage'];

    public function render()
    {
        return view('livewire.admin.pages.edit')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDataEditPage
     * -------------------------------------------------------------------------------
    **/
    public function onDataEditPage(Page $page)
    {
        $this->page_id        = $page->id;
        $this->slug           = $page->slug;
        $this->featured_image = $page->featured_image;
        $this->type           = $page->type;
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
     *  onEditPage
     * -------------------------------------------------------------------------------
    **/
    public function onEditPage($id)
    {
        $this->validate([
            'slug'  => 'required',
        ]);

        try {

            $page                 = Page::findOrFail($id);
            $page->slug           = SlugService::createSlug(Page::class, 'slug', $this->slug);
            $page->type           = strip_tags($this->type);
            $page->featured_image = strip_tags($this->featured_image);
            $page->updated_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editPage']);
            $this->resetInputFields();
            $this->emit('sendUpdatePageStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
