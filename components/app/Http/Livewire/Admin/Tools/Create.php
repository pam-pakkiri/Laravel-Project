<?php

namespace App\Http\Livewire\Admin\Tools;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\PageCategory;
use GrahamCampbell\Security\Facades\Security;

class Create extends Component
{
    public $slug;
    public $tool_name = 'custom_tool_link';
    public $icon_image;
    public $featured_image;
    public $type;
    public $category_id;
    public $custom_tool_link;
    public $position;
    protected $listeners = ['onSetFeaturedImage', 'onSetIconImage'];
    public $tools        = [];
    public $categories   = [];
    public $target = '_self';

    public function mount()
    {
        $this->tools = Storage::disk('local')->get('tools.json');
        $this->categories = PageCategory::orderBy('sort','ASC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.tools.create')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['slug', 'tool_name', 'icon_image', 'custom_tool_link', 'featured_image', 'position']);
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
     *  onSetIconImage
     * -------------------------------------------------------------------------------
    **/
    public function onSetIconImage($value)
    {
        $this->icon_image = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCreateTool
     * -------------------------------------------------------------------------------
    **/
    public function onCreateTool()
    {

        $this->validate([
            'position'  => 'required',
            'tool_name' => 'required'
        ]);

        try {

            $page                   = new Page;
            $page->slug             = 'custom-link-' . time();
            $page->type             = 'tool';
            $page->icon_image       = strip_tags($this->icon_image);
            $page->featured_image   = strip_tags($this->featured_image);
            $page->tool_name        = $this->tool_name;
            $page->category_id      = $this->category_id;
            $page->custom_tool_link = $this->custom_tool_link;
            $page->position         = $this->position;
            $page->target           = Security::clean( strip_tags($this->target) );
            $page->created_at       = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewTool']);
            $this->resetInputFields();
            $this->emit('sendUpdateToolStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
