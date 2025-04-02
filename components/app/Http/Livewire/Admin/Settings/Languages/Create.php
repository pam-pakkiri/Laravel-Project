<?php

namespace App\Http\Livewire\Admin\Settings\Languages;

use Livewire\Component;
use DateTime, File, App;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Languages;
use App\Models\Admin\Translations;

class Create extends Component
{

    public $languages = [];
    public $name;
    public $code;

    public function mount()
    {
        $this->languages = Storage::disk('local')->get('languages.json');
    }

    public function render()
    {
        return view('livewire.admin.settings.languages.create')->layout('layouts.admin');
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['name', 'code']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAddLanguage
     * -------------------------------------------------------------------------------
    **/
    public function onAddLanguage()
    {
 
        try {

            $trans             = new Languages;
            $trans->name       = $this->name;
            $trans->code       = $this->code;
            $trans->created_at = new DateTime();
            $trans->save();

            File::copy( App::langPath() . ('/default.json'), App::langPath() . ('/' . $this->code . '.json') );

            try {

                $jsonData = File::get( App::langPath() . '/' . $this->code . '.json' );

                $transData = json_decode($jsonData);
                
                foreach ($transData as $key => $value) {

                  Translations::create(array(
                    "key"        => $key,
                    "value"      => $value,
                    "lang_id"    => $trans->id,
                    "created_at" => new DateTime()
                  ));
                }

            } catch (Exception $e) {
                $this->addError('error', __('Unable to create new language. Please check your permissions!') );
            }

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewLanguage']);
            $this->resetInputFields();
            $this->emit('sendUpdateLanguageStatus');

        } catch (\Exception $e) {
            $this->addError('error', __('Unable to create new language. Please check your permissions!') );
        }

    }
}
