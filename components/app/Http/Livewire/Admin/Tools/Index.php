<?php

namespace App\Http\Livewire\Admin\Tools;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\Languages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $searchQuery = '';
    protected $listeners = ['onDeleteTool', 'sendUpdateToolStatus' => 'onUpdateToolStatus'];

    public function render()
    {

        //Meta
        $title = __('Tools') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.tools.index', [
            'default_lang'         => Languages::where('default', true)->first()->code,
            'tools'                => Page::where('tool_name', 'like', '%'.$this->searchQuery.'%')->where('type', 'tool')->orderBy('id', 'DESC')->paginate(15),
            'total_lang'           => DB::table('languages')->count(),
            'translation_progress' => PageTranslation::select( 'page_id', DB::raw('count(*) as progress') )->groupBy('page_id')->get()->toArray()
        ])->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Tools' ), 'url' => route('admin.tools.index')]
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
     *  onUpdateToolStatus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateToolStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  arrayKeySearch
     * -------------------------------------------------------------------------------
    **/
    private function arrayKeySearch($array, $key) {

        $result = (array_search($key, array_column($array, 'tool_name')));

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

                $toolData   = Storage::disk('local')->get('tools.json');

                $deJson     = json_decode($toolData);

                $toolsArray = Page::where('type', 'tool')->get(['tool_name', 'position'])->toArray();

                $count      = Page::where('type', 'tool')->get()->max('position');

                foreach ($deJson as $key => $value) {

                    $check = $this->arrayKeySearch($toolsArray, $value);

                    if ( !$check ){

                        $count++;
                        
                        $slug                   = SlugService::createSlug(Page::class, 'slug', $value);

                        $page                   = new Page;
                        $page->slug             = $slug;
                        $page->type             = 'tool';
                        $page->icon_image       = asset('assets/img/tools/' . $slug . '.svg');
                        $page->featured_image   = asset('assets/img/nastuh.jpg');
                        $page->tool_name        = $value;
                        $page->category_id      = null;
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

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data imported successfully!') ]);
                
                $this->mount();

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
            
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onShowEditToolModal
     * -------------------------------------------------------------------------------
    **/
    public function onShowEditToolModal($id)
    {
        $page        = Page::findOrFail($id);
        $this->emit('sendDataEditTool', ['id' => $page->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editTool']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEnableTool
     * -------------------------------------------------------------------------------
    **/
    public function onEnableTool($id)
    {
        try {

            $tool              = Page::findOrFail($id);
            $tool->tool_status = true;
            $tool->updated_at  = new DateTime();
            $tool->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onAds
     * -------------------------------------------------------------------------------
    **/
    public function onAds($id, $adsStatus)
    {
        // Get the tool by ID or throw an exception if not found
        $tool = Page::findOrFail($id);

        // Toggle the popular status
        $tool->ads_status = !$adsStatus;

        // Save the changes
        $tool->save();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onPopularTool
     * -------------------------------------------------------------------------------
    **/
    public function onPopularTool($id, $popularStatus)
    {
        // Get the tool by ID or throw an exception if not found
        $tool = Page::findOrFail($id);

        // Toggle the popular status
        $tool->popular = !$popularStatus;

        // Save the changes
        $tool->save();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDisableTool
     * -------------------------------------------------------------------------------
    **/
    public function onDisableTool($id)
    {
        try {

            $tool              = Page::findOrFail($id);
            $tool->tool_status = false;
            $tool->updated_at  = new DateTime();
            $tool->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteConfirmTool
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteConfirmTool($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteTool
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteTool($id)
    {
        try {
            $page = Page::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
