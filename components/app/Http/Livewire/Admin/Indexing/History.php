<?php

namespace App\Http\Livewire\Admin\Indexing;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Admin\InstantIndexingHistory;
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

        return view('livewire.admin.indexing.history', [
            'histories' => InstantIndexingHistory::orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Instant Indexing' ), 'url' => null],
                ['title' => __( 'History' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onClearHistory
     * -------------------------------------------------------------------------------
    **/
    public function onClearHistory()
    {
        try {

            InstantIndexingHistory::truncate();

            $this->render();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }
    
}
