<?php

namespace App\Http\Livewire\Admin\Tools;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Admin\Page;
use App\Models\Admin\PageCategory;
use App\Models\Admin\Languages;
use App\Models\Admin\Translations;
use Cviebrock\EloquentSluggable\Services\SlugService;
use ZipArchive;
use DateTime;
use File;
use App;

class Addons extends Component
{
    use WithFileUploads;
    public $addons;

    public function render()
    {
        return view('livewire.admin.tools.addons');
    }


    /**
     * -------------------------------------------------------------------------------
     *  onImportAddonPackages
     * -------------------------------------------------------------------------------
    **/
    public function onImportAddonPackages()
    {
        $this->validate([
            'addons' => 'required|file|mimes:zip',
        ]);
 
        $filename = $this->addons->store('livewire-tmp');

        // unzip the file
        $zip = new ZipArchive;

        $path = storage_path('app/'.$filename);

        if ($zip->open($path) === TRUE) {
            $parentDir = dirname(base_path()); // get parent directory
            $zip->extractTo($parentDir); // extract to parent directory
            $zip->close();

            // execute the import.php file
            // pass the current instance to the script
            $addonsComponent = $this;

            include $parentDir . '/import.php';

        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Failed to open the zip file!') ]);
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['addons']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  arrayToolSearch
     * -------------------------------------------------------------------------------
    **/
    private function arrayToolSearch($array, $key) {

        $result = (array_search($key, array_column($array, 'tool_name')));

        return ($result === 0) ? true : $result;
    }

    /**
     * -------------------------------------------------------------------------------
     *  getCategoryID
     * -------------------------------------------------------------------------------
    **/
    private function getCategoryID($array, $title) {
        foreach ($array as $item) {
            if ($item['title'] === $title) {
                return $item['id'];
            }
        }
        return false;
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
     *  onImportTools
     * -------------------------------------------------------------------------------
    **/
    public function onImportTools()
    {

        try {

                $toolFilePath = dirname(base_path()) . '/tools.json';
                $importFilePath = dirname(base_path()) . '/import.php';

                if (File::exists($toolFilePath)) {

                    $toolData        = File::get($toolFilePath);

                    $deJson          = json_decode($toolData);

                    $toolsArray      = Page::where('type', 'tool')->get(['tool_name', 'position'])->toArray();

                    $CategoriesArray = PageCategory::get(['id','title'])->toArray();

                    $count           = Page::where('type', 'tool')->get()->max('position');

                    foreach ($deJson as $categoryName => $tools) {

                        $categoryID = $this->getCategoryID($CategoriesArray, $categoryName);

                        if ( !$categoryID ) {

                            $category              = new PageCategory;
                            $category->title       = $categoryName;
                            $category->description = null;
                            $category->align       = 'start';
                            $category->background  = 'bg-teal';
                            $category->created_at  = new DateTime();
                            $category->save();

                            $categoryID            = $category->id;
                        }

                        foreach ($tools as $value) {

                            $checkToolExists = $this->arrayToolSearch($toolsArray, $value);

                            if ( !$checkToolExists ){

                                $count++;
                                
                                $slug                   = SlugService::createSlug(Page::class, 'slug', $value);

                                $page                   = new Page;
                                $page->slug             = $slug;
                                $page->type             = 'tool';
                                $page->icon_image       = asset('assets/img/tools/' . $slug . '.svg');
                                $page->featured_image   = asset('assets/img/nastuh.jpg');
                                $page->tool_name        = $value;
                                $page->category_id      = $categoryID;
                                $page->custom_tool_link = null;
                                $page->position         = $count;
                                $page->created_at       = new DateTime();
                                $page->save();

                                $pageTrans = Page::findOrFail( $page->id );

                                $defaultLocate = Languages::where('default', true)->first()->code;

                                $pageTrans->translateOrNew($defaultLocate)->page_title        = $value;
                                $pageTrans->translateOrNew($defaultLocate)->title             = $value;
                                $pageTrans->translateOrNew($defaultLocate)->subtitle          = null;
                                $pageTrans->translateOrNew($defaultLocate)->short_description = $value;
                                $pageTrans->translateOrNew($defaultLocate)->description       = null;
                                $pageTrans->translateOrNew($defaultLocate)->sitename_status   = true;
                                $pageTrans->translateOrNew($defaultLocate)->robots_meta       = true;
                                $pageTrans->save();

                            }

                        }
                    }

                    $this->onImportTranslations();

                    $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data imported successfully!') ]);
                    $this->dispatchBrowserEvent('closeModal', ['id' => 'importAddonPackages']);
                    $this->resetInputFields();
                    $this->emit('sendUpdateToolStatus');
                    $this->render();
                    File::delete($toolFilePath);
                    File::delete($importFilePath);

                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('File does not exist!') ]);
                }

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
            
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onImportTranslations
     * -------------------------------------------------------------------------------
    **/
    private function onImportTranslations()
    {
        try {

                $transFilePath = dirname(base_path()) . '/translations.json';

                $fileContents = File::get($transFilePath);
                
                $deJson    = json_decode($fileContents);

                $langID = Languages::where('default', true)->first()->id;

                $transArray = Translations::where('lang_id', $langID)->get(['key', 'value'])->toArray();

                foreach ($deJson as $key => $value) {

                    $check = $this->arrayKeySearch($transArray, $key);

                    if ( !$check ){
                        $trans             = new Translations;
                        $trans->key        = $key;
                        $trans->value      = $value;
                        $trans->lang_id    = $langID;
                        $trans->created_at = new DateTime();
                        $trans->save();
                    }
                }

                //Export translation to JSON file
                
                $transData = Translations::where('lang_id', $langID)->get(['key', 'value']);

                $defaultLocate = Languages::where('default', true)->first()->code;

                $arrayData = array();

                foreach ($transData as $value) {
                    $arrayData += array( strip_tags($value['key']) => strip_tags($value['value']) );
                }

                $jsonData = json_encode($arrayData, true);

                File::put( App::langPath() . ('/' . $defaultLocate . '.json'), $jsonData );

                File::delete($transFilePath);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
            
        }
    }
    
}
