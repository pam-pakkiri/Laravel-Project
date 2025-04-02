<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Menu as MS;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\SEOMeta;

class Menus extends Component
{
    public $menu_items;
    public $icon;
    public $fontawesome = [];

    public $text;
    public $url  = '#';
    public $type = 'link';
    public $target = '_self';
    public $class;
    public $itemID;

    public $menus = [];
    public $pages = [];
    protected $listeners = ['onUpdateMenus'];

    public function mount()
    {
        $this->menus       = MS::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray();
        $this->pages       = Page::orderBy('id', 'DESC')->get()->toArray();
        $this->fontawesome = Storage::disk('local')->get('fontawesome.json');
    }

    public function render()
    {

        //Meta
        $title = __('Menus') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.menus')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Menus' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  resetInputFields
     * -------------------------------------------------------------------------------
    **/
    private function resetInputFields()
    {
        $this->reset(['text', 'menu_items', 'url', 'target', 'icon', 'type', 'class', 'itemID']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  addToMenu
     * -------------------------------------------------------------------------------
    **/
    public function addToMenu()
    {
        try {

            if ( $this->itemID != null ) {

                $ms             = MS::findOrFail($this->itemID);
                $ms->text       = Security::clean( strip_tags($this->text) );
                $ms->menu_items = ($this->menu_items == 'custom') ? Security::clean( strip_tags($this->menu_items) ) : Security::clean( strip_tags($this->url) );
                $ms->url        = ($this->menu_items == 'custom') ? Security::clean( strip_tags($this->url) ) : Security::clean( strip_tags($this->menu_items) );
                $ms->target     = Security::clean( strip_tags($this->target) );
                $ms->icon       = ($this->icon) ? Security::clean( strip_tags($this->icon) ) : null;
                $ms->type       = $this->type;
                $ms->class      = $this->class;
                $ms->updated_at = new DateTime();
                $ms->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

            } else{

                $ms             = new MS;           
                $ms->text       = Security::clean( strip_tags($this->text) );
                $ms->menu_items = ($this->menu_items == 'custom') ? Security::clean( strip_tags($this->menu_items) ) : Security::clean( strip_tags($this->url) );
                $ms->url        = ($this->menu_items == 'custom') ? Security::clean( strip_tags($this->url) ) : Security::clean( strip_tags($this->menu_items) );
                $ms->target     = Security::clean( strip_tags($this->target) );
                $ms->icon       = ($this->icon) ? Security::clean( strip_tags($this->icon) ) : null;
                $ms->type       = $this->type;
                $ms->class      = $this->class;
                $ms->created_at = new DateTime();
                $ms->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!')]);
            }

            $this->mount();
            $this->render();
            $this->resetInputFields();
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  editMenu
     * -------------------------------------------------------------------------------
    **/
    public function editMenu($id)
    {
        try {

            $this->itemID     = $id;
            $ms               = MS::findOrFail($id);
            $this->text       = $ms->text;
            $this->menu_items = ($ms->menu_items == 'custom') ? Security::clean( strip_tags($ms->menu_items)) : Security::clean( strip_tags($ms->url));
            $this->url        = ($ms->menu_items == 'custom') ? Security::clean( strip_tags($ms->url)) : Security::clean( strip_tags($ms->menu_items));
            $this->target     = Security::clean( strip_tags($ms->target) );
            $this->icon       = ($ms->icon) ? $ms->icon : null;
            $this->type       = $ms->type;
            $this->class      = $ms->class;

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  removeMenu
     * -------------------------------------------------------------------------------
    **/
    public function removeMenu($id)
    {

        try {
            $ms = MS::findOrFail($id);

            $ms->delete($id);
            return redirect()->route('admin.menus.index');

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  parseJsonArray
     * -------------------------------------------------------------------------------
    **/
    public function parseJsonArray($jsonArray, $parentID = 0) {

      $return = array();

      foreach ($jsonArray as $subArray) {

        $returnSubSubArray = array();

        if (isset($subArray['children'])) {

            $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
        }

        $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);

        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateMenus
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateMenus($data)
    {

        try {

            $data = $this->parseJsonArray($data);

            $i = 0;

            foreach ($data as $row) {

                $i++;
                $ms             = MS::findOrFail($row['id']);
                $ms->parent_id  = $row['parentID'];
                $ms->sort       = $i;
                $ms->updated_at = new DateTime();
                $ms->save();
            }
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
        
    }
}
