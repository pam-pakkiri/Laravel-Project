<?php

namespace App\Http\Livewire\Admin\Settings\Footer;

use Livewire\Component;
use App\Models\Admin\Footer;
use Artesaos\SEOTools\Facades\SEOMeta;

class Create extends Component
{
    public $layout;
    public $widget1;
    public $widget2;
    public $widget3;
    public $widget4;
    public $widget5;
    public $bottom_text;

    public $locale;

    public function mount($locale)
    {
        $this->locale  = $locale;
    }

    public function render()
    {

        //Meta
        $title = __('Create Footer Translation') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.footer.create')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Footer' ), 'url' => route('admin.footer.index')],
                ['title' => __( 'Create' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onCreateFooterTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onCreateFooterTranslation()
    {   

        try {

            $footer = Footer::findOrFail(1);

            if ( $footer->hasTranslation($this->locale) == true ) {

                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('This footer language has been translated. You can edit it on the translation page!') ]);
            }
            else {

                $footer->translateOrNew($this->locale)->layout      = !empty($this->layout[$this->locale]) ? strip_tags($this->layout[$this->locale]) : '';
                $footer->translateOrNew($this->locale)->widget1     = !empty($this->widget1[$this->locale]) ? $this->widget1[$this->locale] : '';
                $footer->translateOrNew($this->locale)->widget2     = !empty($this->widget2[$this->locale]) ? $this->widget2[$this->locale] : '';
                $footer->translateOrNew($this->locale)->widget3     = !empty($this->widget3[$this->locale]) ? $this->widget3[$this->locale] : '';
                $footer->translateOrNew($this->locale)->widget4     = !empty($this->widget4[$this->locale]) ? $this->widget4[$this->locale] : '';
                $footer->translateOrNew($this->locale)->widget5     = !empty($this->widget5[$this->locale]) ? $this->widget5[$this->locale] : '';
                $footer->translateOrNew($this->locale)->bottom_text = !empty($this->bottom_text[$this->locale]) ? $this->bottom_text[$this->locale] : '';
                
                $footer->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
         
    }

}
