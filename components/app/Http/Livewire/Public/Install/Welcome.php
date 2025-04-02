<?php

namespace App\Http\Livewire\Public\Install;

use Livewire\Component;
use App\Models\Install;
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.public.install.welcome')->layout('layouts.install');
    }
}
