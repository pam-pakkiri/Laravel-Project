<?php

namespace App\Http\Livewire\Admin\Settings\Languages;

use Livewire\Component;
use DateTime, App, File;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Languages;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\FooterTranslation;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
	
    protected $listeners = ['onDeleteLanguage', 'sendUpdateLanguageStatus' => 'onUpdateLanguageStatus'];

    public function render()
    {

        //Meta
        $title = __('Language Translations') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.languages.index', [
            'languages' => Languages::orderBy('id', 'DESC')->paginate(15)
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Languages' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetDefault
     * -------------------------------------------------------------------------------
    **/
    public function onSetDefault($id)
    {
        try {

            Languages::where('default', '=', true)->update( ['default' => false] );
            $trans             = Languages::findOrFail($id);
            $trans->default    = true;
            $trans->updated_at = new DateTime();
            $trans->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->render();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateLanguageStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateLanguageStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditLanguageModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditLanguageModal($id)
    {
        try {
            $trans        = Languages::findOrFail($id);

            $this->emit('sendDataEditLanguage', ['lang_id' => $trans->id]);
            $this->dispatchBrowserEvent('showModal', ['id' => 'editLanguage']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onEnableLanguage
     * -------------------------------------------------------------------------------
    **/
    public function onEnableLanguage($id)
    {
        try {

            $lang             = Languages::findOrFail($id);
            $lang->status     = true;
            $lang->updated_at = new DateTime();
            $lang->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            $this->render();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDisableLanguage
     * -------------------------------------------------------------------------------
    **/
    public function onDisableLanguage($id)
    {
        try {

            $lang             = Languages::findOrFail($id);

            if ($lang->default) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('The default language cannot be disabled.') ]);
            }
            else{
                
                $lang->status     = false;
                $lang->updated_at = new DateTime();
                $lang->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
                $this->render();
            }
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteLanguageConfirm
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteLanguageConfirm( $id )
    {
        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!')]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteLanguage
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteLanguage($id)
    {
        try {

            $trans = Languages::findOrFail($id);
            $trans->delete($id);

            $page_trans = PageTranslation::where('locale', $trans->code)->get();
            foreach ($page_trans as $page_tran) {
                $page_tran->delete($page_tran->id);
            }

            $footer_trans = FooterTranslation::where('locale', $trans->code)->get();
            foreach ($footer_trans as $footer_tran) {
                $footer_tran->delete($footer_tran->id);
            }

            try {
                
                File::delete( App::langPath() . ('/' . $trans->code . '.json') );

            } catch (\Exception $e) {

                $this->addError('error', __('Cannot delete file. Please check your permissions!'));
            }

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->render();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
