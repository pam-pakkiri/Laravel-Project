<?php

namespace App\Http\Livewire\Public\Install;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Install;

class Finished extends Component
{

    public function mount(){
        $install                  = Install::findOrFail(1);
        if (!$install->database) return redirect()->route('sw_database');
        else if (!$install->account) return redirect()->route('sw_account');
        else if (!$install->import) return redirect()->route('sw_import');

        $ins           = Install::findOrFail(1);
        $ins->finished = true;
        $ins->save();
    }

    public function render()
    {
        return view('livewire.public.install.finished')->layout('layouts.install');
    }
}
