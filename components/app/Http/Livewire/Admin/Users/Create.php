<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use DateTime;
use App\Models\Admin\User;
use Auth;

class Create extends Component
{
    public $fullname;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.admin.users.create')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['email', 'password']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCreateUser
     * -------------------------------------------------------------------------------
    **/
    public function onCreateUser()
    {

        $this->validate([
            'fullname' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {

            if ( Auth::user()->is_admin == 1 ) {

                $user             = new User;
                $user->fullname = $this->fullname;
                $user->email    = $this->email;
                $user->is_admin = false;

                if ( $this->password != '' ) {
                    $user->password = bcrypt($this->password);
                }

                $user->updated_at = new DateTime();
                $user->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
                $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewUser']);
                $this->resetInputFields();
                $this->emit('sendUpdateUserStatus');
            }
            else $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Access denied!')]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
