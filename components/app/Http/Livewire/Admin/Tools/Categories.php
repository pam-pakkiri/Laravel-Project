<?php

namespace App\Http\Livewire\Admin\Tools;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\PageCategory;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;
use Artesaos\SEOTools\Facades\SEOMeta;

class Categories extends Component
{

    public $title;
    public $description;
    public $align = 'start';
    public $background = 'bg-white';
    public $categories = [];
    public $cateID;

    protected $listeners = ['onUpdateCategory'];

    public function mount()
    {
        $this->categories = PageCategory::orderBy('sort','ASC')->get()->toArray();
    }

    public function render()
    {
        //Meta
        $title = __('Tool Categories') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.tools.categories')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Categories' ), 'url' => route('admin.tools.categories.index')]
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
        $this->reset(['title', 'description', 'align', 'background', 'cateID']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  addNewCategory
     * -------------------------------------------------------------------------------
    **/
    public function addNewCategory()
    {
        try {

            if ( $this->cateID != null ) {

                $cate              = PageCategory::findOrFail($this->cateID);
                $cate->title       = Security::clean( strip_tags($this->title) );
                $cate->description = Security::clean( strip_tags($this->description) );
                $cate->align       = Security::clean( strip_tags($this->align) );
                $cate->background  = Security::clean( strip_tags($this->background) );
                $cate->updated_at  = new DateTime();
                $cate->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

            } else{

                $cate              = new PageCategory;
                $cate->title       = Security::clean( strip_tags($this->title) );
                $cate->description = Security::clean( strip_tags($this->description) );
                $cate->align       = Security::clean( strip_tags($this->align) );
                $cate->background  = Security::clean( strip_tags($this->background) );
                $cate->created_at  = new DateTime();
                $cate->save();
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
     *  editCategory
     * -------------------------------------------------------------------------------
    **/
    public function editCategory($id)
    {
        try {

            $this->cateID      = $id;
            $cate              = PageCategory::findOrFail($id);
            $this->title       = Security::clean( strip_tags($cate->title) );
            $this->description = Security::clean( strip_tags($cate->description) );
            $this->align       = Security::clean( strip_tags($cate->align) );
            $this->background  = Security::clean( strip_tags($cate->background) );

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  removeCategory
     * -------------------------------------------------------------------------------
    **/
    public function removeCategory($id)
    {

        try {
            $cate = PageCategory::findOrFail($id);

            $cate->delete($id);
            return redirect()->route('admin.tools.categories.index');

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

        $return[] = array('id' => $subArray['id']);

        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateCategory
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateCategory($data)
    {

        try {

            $data = $this->parseJsonArray($data);

            $i = 0;

            foreach ($data as $row) {

                $i++;
                $cate             = PageCategory::findOrFail($row['id']);
                $cate->sort       = $i;
                $cate->updated_at = new DateTime();
                $cate->save();
            }
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
        
    }

}
