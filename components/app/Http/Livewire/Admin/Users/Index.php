<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\Admin\User;
use Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $searchQuery        = '';
    protected $listeners       = ['onDeleteUser', 'sendUpdateUserStatus' => 'onUpdateUserStatus'];

    public function render()
    {

        //Meta
        $title = __('Users') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.users.index', [
            'users' => User::where('email', 'like', '%'.$this->searchQuery.'%')->orWhere('fullname', 'like', '%'.$this->searchQuery.'%')->orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Users' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateUserStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateUserStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditUserModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditUserModal($id)
    {
        $user        = User::findOrFail($id);
        $this->emit('sendDataEditUser', ['id' => $user->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editUser']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmUser
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmUser($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteUser
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteUser($id)
    {
        try {

            if ( Auth::user()->is_admin == 1 ) {

                $user = User::findOrFail($id);
                $user->delete($id);

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            }
            else $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Access denied!')]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
