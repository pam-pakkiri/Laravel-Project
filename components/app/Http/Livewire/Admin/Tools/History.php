<?php

namespace App\Http\Livewire\Admin\Tools;

use Livewire\Component;
use App\Models\Admin\History as HT;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    public function render()
    {
        //Meta
        $title = __('History') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.tools.history', [
            'histories' => HT::orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Tools' ), 'url' => null],
                ['title' => __( 'History' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteHistory
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteHistory($id)
    {
        try {
            $history = HT::findOrFail($id);

            $history->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
