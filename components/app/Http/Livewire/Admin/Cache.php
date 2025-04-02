<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Artesaos\SEOTools\Facades\SEOMeta;

class Cache extends Component
{
    protected $listeners = ['onClearCache'];

    public function render()
    {

        //Meta
        $title = __('Cache') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.cache')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Cache' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onClearCache
     * -------------------------------------------------------------------------------
    **/
    public function onClearCache()
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('All caches have been cleared!') ]);
    }
}
