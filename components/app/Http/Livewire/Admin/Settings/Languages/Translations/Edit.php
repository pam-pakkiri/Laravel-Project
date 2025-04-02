<?php

namespace App\Http\Livewire\Admin\Settings\Languages\Translations;

use Livewire\Component;
use File;
use App;
use DateTime;
use App\Models\Admin\Translations;
use App\Models\Admin\Languages;
use Artesaos\SEOTools\Facades\SEOMeta;

class Edit extends Component
{

    public $searchQuery = '';

    public $lang_id;
    public $lang_name = '';

    public $translations = [];
    public $value;
    public $key;

    protected $listeners = ['sendUpdateTranslationStatus' => 'onUpdateTranslationStatus'];

    public function mount($lang_id)
    {
        $this->lang_id   = $lang_id;
        $this->lang_name = Languages::findOrFail($this->lang_id)->name;
    }

    public function render()
    {

        //Meta
        $title = __('Edit Language Translation') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        $this->translations = Translations::where('lang_id', $this->lang_id )->where(function ($query) {
               $query->where('key', 'like', '%'.$this->searchQuery.'%')
                     ->orWhere('value', 'like', '%'.$this->searchQuery.'%');
           })->orderBy('id', 'DESC')->get()->toArray();

        return view('livewire.admin.settings.languages.translations.edit',[
            'translations' => $this->translations
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Languages' ), 'url' => route('admin.languages.index')],
                ['title' => __( 'Translations' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateTranslationStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateTranslationStatus(){
        $this->mount($this->lang_id);
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
     *  arrayKeySearch
     * -------------------------------------------------------------------------------
    **/
    private function arrayKeySearch($array, $key) {

        $result = (array_search($key, array_column($array, 'key')));

        return ($result === 0) ? true : $result;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onImportTranslations
     * -------------------------------------------------------------------------------
    **/
    public function onImportTranslations()
    {
        try {

                $langData  = File::get( App::langPath() . ('/'.Languages::where('default', true)->first()->code.'.json') );

                $deJson    = json_decode($langData);

                $transArray = Translations::where('lang_id', $this->lang_id)->get(['key', 'value'])->toArray();

                foreach ($deJson as $key => $value) {

                    $check = $this->arrayKeySearch($transArray, $key);

                    if ( !$check ){
                        $trans             = new Translations;
                        $trans->key        = $key;
                        $trans->value      = $value;
                        $trans->lang_id    = $this->lang_id;
                        $trans->created_at = new DateTime();
                        $trans->save();
                    }
                }

                $transData = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

                $trans = Languages::findOrFail($this->lang_id);

                $arrayData = array();

                foreach ($transData as $value) {
                    $arrayData += array( strip_tags($value['key']) => strip_tags($value['value']) );
                }

                $jsonData = json_encode($arrayData, true);

                File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data imported successfully!') ]);
                
                $this->mount($this->lang_id);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
            
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateTranslation()
    {

        $this->validate([
            'translations.*.key'   => 'required',
            'translations.*.value' => 'required'
        ]);

        if ( !empty($this->translations) ) {

            foreach ($this->translations as $key => $value) {
                
                $trans             = Translations::findOrFail($value['id']);
                $trans->value      = strip_tags( $value['value'] );
                $trans->updated_at = new DateTime();
                $trans->save();
            }

            try {
     
                $trans           = Languages::findOrFail($this->lang_id);
                $transData       = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

                $arrayData = array();

                foreach ($transData as $value) {
                    $arrayData += array( strip_tags($value['key']) => strip_tags($value['value']) );
                }

                $jsonData = json_encode($arrayData, true);

                File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
                $this->mount($this->lang_id);

            } catch (\Exception $e) {

                $this->addError('error', __($e->getMessage()) );
                
            }

        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteTranslation
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteTranslation($id)
    {
 
        $trans = Translations::findOrFail($id);

        $trans->delete($id);

        try {
 
            $trans           = Languages::findOrFail($this->lang_id);
            $transData       = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

            $arrayData = array();

            foreach ($transData as $value) {
                $arrayData += array( $value['key'] => $value['value'] );
            }

            $jsonData = json_encode($arrayData, true);

            File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            $this->mount($this->lang_id);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
        }

    }

}
