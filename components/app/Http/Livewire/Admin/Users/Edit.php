<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use DateTime;
use App\Models\Admin\User;
use Auth;

class Edit extends Component
{
    public $fullname;
    public $user_id;
    public $email;
    public $password;
    protected $listeners = ['sendDataEditUser' => 'onDataEditUser'];

    public function render()
    {
        return view('livewire.admin.users.edit')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDataEditUser
     * -------------------------------------------------------------------------------
    **/
    public function onDataEditUser(User $user)
    {
        $this->user_id  = $user->id;
        $this->fullname = $user->fullname;
        $this->email    = $user->email;
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
     *  onEditUser
     * -------------------------------------------------------------------------------
    **/
    public function onEditUser($id)
    {
        $this->validate([
            'fullname' => 'required',
            'email'    => 'required|email'
        ]);

        try {

            if ( Auth::user()->is_admin == 1 ) {

                $user           = User::findOrFail($id);
                $user->fullname = $this->fullname;
                $user->email    = $this->email;

                if ( $this->password != '' ) {
                    $user->password = bcrypt($this->password);
                }

                $user->updated_at = new DateTime();
                $user->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
                $this->dispatchBrowserEvent('closeModal', ['id' => 'editUser']);
                $this->resetInputFields();
                $this->emit('sendUpdateUserStatus');
            }
            else $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Access denied!')]);
                
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
