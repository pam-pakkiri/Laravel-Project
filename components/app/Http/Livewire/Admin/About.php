<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOMeta;

class About extends Component
{
    public function render()
    {

        //Meta
        $title = __('About') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.about')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'About' ), 'url' => null]
            ]
        ]);
    }
}
