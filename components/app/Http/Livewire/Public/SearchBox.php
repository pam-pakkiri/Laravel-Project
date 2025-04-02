<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Page;

class SearchBox extends Component
{
    public $searchQuery = '';
    public $search_queries = [];

    public function render()
    {
        return view('livewire.public.search-box');

    }

    /**
     * -------------------------------------------------------------------------------
     *  onSearch
     * -------------------------------------------------------------------------------
    **/
    public function onSearch(){
        $this->search_queries = Page::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'tool')->where('title', 'LIKE', '%'.$this->searchQuery.'%')->where('tool_status', true)->orderByTranslation('id', 'DESC')->get()->toArray();
    }
}
