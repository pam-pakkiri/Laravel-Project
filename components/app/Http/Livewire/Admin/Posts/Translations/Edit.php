<?php

namespace App\Http\Livewire\Admin\Posts\Translations;

use Livewire\Component;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\Page;
use App\Models\Admin\Languages;
use Artesaos\SEOTools\Facades\SEOMeta;

class Edit extends Component
{
    public $page_title;
    public $title;
    public $subtitle;
    public $short_description;
    public $description;

    public $page_type, $slug;
    public $transId, $locale, $lang_name, $page_id;
    public $sitename_status;
    public $robots_meta;

    public function mount($trans_id)
    {
        $this->transId           = $trans_id;

        $pageTrans               = PageTranslation::findOrFail($trans_id);
        $this->page_id           = $pageTrans->page_id;
        $this->locale            = $pageTrans->locale;
        $this->lang_name         = Languages::where('code', $pageTrans->locale)->first()->name;
        $this->slug              = Page::where('id', $pageTrans->page_id)->first()->slug;
        $this->page_type         = Page::where('id', $pageTrans->page_id)->first()->type;
        $this->page_title        = $pageTrans->page_title;
        $this->title             = $pageTrans->title;
        $this->subtitle          = $pageTrans->subtitle;
        $this->short_description = $pageTrans->short_description;
        $this->description       = $pageTrans->description;
        $this->sitename_status   = $pageTrans->sitename_status;
        $this->robots_meta       = $pageTrans->robots_meta;
    }

    public function render()
    {

        //Meta
        $title = __('Edit Post Translation') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.posts.translations.edit')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Posts' ), 'url' => route('admin.posts.index')],
                ['title' => __( 'Translations' ), 'url' => route('admin.posts.translations.index', ['page_id' => $this->page_id])],
                ['title' => __( 'Edit' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEditPostTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onEditPostTranslation()
    {   

        $this->validate([
            'title' => 'required'
        ]);

        try {

            $page                    = PageTranslation::findOrFail($this->transId);
            
            $page->page_title        = !empty($this->page_title) ? strip_tags($this->page_title) : '';
            $page->title             = !empty($this->title) ? strip_tags($this->title) : '';
            $page->subtitle          = !empty($this->subtitle) ? strip_tags($this->subtitle) : '';
            $page->short_description = !empty($this->short_description) ? strip_tags($this->short_description) : '';
            $page->description       = !empty($this->description) ? $this->description : '';
            $page->sitename_status   = $this->sitename_status;
            $page->robots_meta       = $this->robots_meta;
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
