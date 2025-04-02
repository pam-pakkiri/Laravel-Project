<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Advertisement as Ads;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;
use Artesaos\SEOTools\Facades\SEOMeta;

class Advertisements extends Component
{

    public $area1;
    public $area1_status;
    public $area1_align;
    public $area1_margin;
    
    public $area2;
    public $area2_status;
    public $area2_align;
    public $area2_margin;
    
    public $area3;
    public $area3_status;
    public $area3_align;
    public $area3_margin;
    
    public $area4;
    public $area4_status;
    public $area4_align;
    public $area4_margin;

    public $area5;
    public $area5_status;
    public $area5_align;
    public $area5_margin;

    public $sidebar_top;
    public $sidebar_top_status;
    public $sidebar_top_sticky;
    public $sidebar_top_align;
    public $sidebar_top_margin;

    public $sidebar_middle;
    public $sidebar_middle_status;
    public $sidebar_middle_sticky;
    public $sidebar_middle_align;
    public $sidebar_middle_margin;

    public $sidebar_bottom;
    public $sidebar_bottom_status;
    public $sidebar_bottom_sticky;
    public $sidebar_bottom_align;
    public $sidebar_bottom_margin;

    public function mount()
    {
        $ads                         = Ads::findOrFail(1);

        $this->area1                 = $ads->area1;
        $this->area1_status          = $ads->area1_status;
        $this->area1_align           = $ads->area1_align;
        $this->area1_margin          = $ads->area1_margin;
        
        $this->area2                 = $ads->area2;
        $this->area2_status          = $ads->area2_status;
        $this->area2_align           = $ads->area2_align;
        $this->area2_margin          = $ads->area2_margin;
        
        $this->area3                 = $ads->area3;
        $this->area3_status          = $ads->area3_status;
        $this->area3_align           = $ads->area3_align;
        $this->area3_margin          = $ads->area3_margin;
        
        $this->area4                 = $ads->area4;
        $this->area4_status          = $ads->area4_status;
        $this->area4_align           = $ads->area4_align;
        $this->area4_margin          = $ads->area4_margin;

        $this->area5                 = $ads->area5;
        $this->area5_status          = $ads->area5_status;
        $this->area5_align           = $ads->area5_align;
        $this->area5_margin          = $ads->area5_margin;

        $this->sidebar_top           = $ads->sidebar_top;
        $this->sidebar_top_status    = $ads->sidebar_top_status;
        $this->sidebar_top_sticky    = $ads->sidebar_top_sticky;
        $this->sidebar_top_align     = $ads->sidebar_top_align;
        $this->sidebar_top_margin    = $ads->sidebar_top_margin;

        $this->sidebar_middle        = $ads->sidebar_middle;
        $this->sidebar_middle_status = $ads->sidebar_middle_status;
        $this->sidebar_middle_sticky = $ads->sidebar_middle_sticky;
        $this->sidebar_middle_align  = $ads->sidebar_middle_align;
        $this->sidebar_middle_margin = $ads->sidebar_middle_margin;

        $this->sidebar_bottom        = $ads->sidebar_bottom;
        $this->sidebar_bottom_status = $ads->sidebar_bottom_status;
        $this->sidebar_bottom_sticky = $ads->sidebar_bottom_sticky;
        $this->sidebar_bottom_align  = $ads->sidebar_bottom_align;
        $this->sidebar_bottom_margin = $ads->sidebar_bottom_margin;
    }

    public function render()
    {

        //Meta
        $title = __('Advertisements') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.advertisements')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Advertisements' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateADS
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateADS()
    {
        try {

            $ads                        = Ads::findOrFail(1);
            $ads->area1                 = $this->area1;
            $ads->area1_status          = $this->area1_status;
            $ads->area1_align           = $this->area1_align;
            $ads->area1_margin          = $this->area1_margin;

            $ads->area2                 = $this->area2;
            $ads->area2_status          = $this->area2_status;
            $ads->area2_align           = $this->area2_align;
            $ads->area2_margin          = $this->area2_margin;

            $ads->area3                 = $this->area3;
            $ads->area3_status          = $this->area3_status;
            $ads->area3_align           = $this->area3_align;
            $ads->area3_margin          = $this->area3_margin;

            $ads->area4                 = $this->area4;
            $ads->area4_status          = $this->area4_status;
            $ads->area4_align           = $this->area4_align;
            $ads->area4_margin          = $this->area4_margin;

            $ads->area5                 = $this->area5;
            $ads->area5_status          = $this->area5_status;
            $ads->area5_align           = $this->area5_align;
            $ads->area5_margin          = $this->area5_margin;

            $ads->sidebar_top           = $this->sidebar_top;
            $ads->sidebar_top_status    = $this->sidebar_top_status;
            $ads->sidebar_top_sticky    = $this->sidebar_top_sticky;
            $ads->sidebar_top_align     = $this->sidebar_top_align;
            $ads->sidebar_top_margin    = $this->sidebar_top_margin;

            $ads->sidebar_middle        = $this->sidebar_middle;
            $ads->sidebar_middle_status = $this->sidebar_middle_status;
            $ads->sidebar_middle_sticky = $this->sidebar_middle_sticky;
            $ads->sidebar_middle_align  = $this->sidebar_middle_align;
            $ads->sidebar_middle_margin = $this->sidebar_middle_margin;

            $ads->sidebar_bottom        = $this->sidebar_bottom;
            $ads->sidebar_bottom_status = $this->sidebar_bottom_status;
            $ads->sidebar_bottom_sticky = $this->sidebar_bottom_sticky;
            $ads->sidebar_bottom_align  = $this->sidebar_bottom_align;
            $ads->sidebar_bottom_margin = $this->sidebar_bottom_margin;

            $ads->updated_at            = new DateTime();
            $ads->save();

            $this->mount();
            $this->render();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
