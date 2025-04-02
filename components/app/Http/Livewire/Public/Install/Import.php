<?php

namespace App\Http\Livewire\Public\Install;

use Livewire\Component;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Artisan;
use App\Models\Install;
class Import extends Component
{

    public function mount(){
        $install                  = Install::findOrFail(1);
        if (!$install->database) return redirect()->route('sw_database');
        else if (!$install->account) return redirect()->route('sw_account');
    }

    public function render()
    {
        return view('livewire.public.install.import')->layout('layouts.install');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onImportData
     * -------------------------------------------------------------------------------
    **/
    public function onImportData(){

        Artisan::call('db:seed', ['class' => 'DatabaseSeeder']);

        $install         = Install::findOrFail(1);
        $install->import = true;
        $install->save();

        return redirect()->route('sw_finished');

    }
}
