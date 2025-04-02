<?php

namespace App\Http\Livewire\Admin\Settings\Footer;

use Livewire\Component;
use App\Models\Admin\FooterTranslation;
use Artesaos\SEOTools\Facades\SEOMeta;

class Edit extends Component
{

    public $layout;
    public $widget1;
    public $widget2;
    public $widget3;
    public $widget4;
    public $widget5;
    public $bottom_text;

    public $trans_id;
    public $locale;

    public function mount($trans_id)
    {
        $this->trans_id     = $trans_id;

        $footerTrans       = FooterTranslation::findOrFail($this->trans_id);
        $this->locale      = $footerTrans->locale;
        $this->layout      = $footerTrans->layout;
        $this->widget1     = $footerTrans->widget1;
        $this->widget2     = $footerTrans->widget2;
        $this->widget3     = $footerTrans->widget3;
        $this->widget4     = $footerTrans->widget4;
        $this->widget5     = $footerTrans->widget5;
        $this->bottom_text = $footerTrans->bottom_text;

    }

    public function render()
    {

        //Meta
        $title = __('Edit Footer Translation') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.footer.edit')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Footer' ), 'url' => route('admin.footer.index')],
                ['title' => __( 'Edit' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateFooterTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateFooterTranslation()
    {   
        try {

            $footer              = FooterTranslation::findOrFail($this->trans_id);
            $footer->layout      = !empty($this->layout) ? strip_tags($this->layout) : '';
            $footer->widget1     = !empty($this->widget1) ? $this->widget1 : '';
            $footer->widget2     = !empty($this->widget2) ? $this->widget2 : '';
            $footer->widget3     = !empty($this->widget3) ? $this->widget3 : '';
            $footer->widget4     = !empty($this->widget4) ? $this->widget4 : '';
            $footer->widget5     = !empty($this->widget5) ? $this->widget5 : '';
            $footer->bottom_text = !empty($this->bottom_text) ? $this->bottom_text : '';
            
            $footer->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
         
    }

}
