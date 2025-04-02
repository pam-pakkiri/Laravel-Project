<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Auth;
use Artesaos\SEOTools\Facades\SEOMeta;

class Index extends Component
{

    public function render()
    {

        //Meta
        $title = __('Profile') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.profile.index')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Profile' ), 'url' => route('admin.profile.index')]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onLogout
     * -------------------------------------------------------------------------------
    **/
    public function onLogout()
    {
    	Auth::logout();
    	return redirect('/');
    }

}
