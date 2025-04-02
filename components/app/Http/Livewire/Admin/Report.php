<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Report as RP;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Report extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public $searchQuery = '';

    protected $listeners = ['onDeleteReport'];
	
    public function render()
    {

        //Meta
        $title = __('Report') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.report', [
            'reports' => RP::orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Report' ), 'url' => null]
            ]
        ]);

    }

    /**
     * -------------------------------------------------------------------------------
     *  updatingSearch
     * -------------------------------------------------------------------------------
    **/
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirm
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirm( $id )
    {
        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteReport
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteReport( $id )
    {

        $report = RP::findOrFail($id);

        $report->delete($id);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
    }

}
