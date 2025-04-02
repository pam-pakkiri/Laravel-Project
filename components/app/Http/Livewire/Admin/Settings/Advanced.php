<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Advanced as Insert;
use Artesaos\SEOTools\Facades\SEOMeta;
use Brotzka\DotenvEditor\DotenvEditor;

class Advanced extends Component
{

	public $insert_header;
	public $header_status;

	public $insert_body;
	public $body_status;

	public $insert_footer;
	public $footer_status;

	public $remote_libreoffice;

    public function mount()
    {
		$insert                                  = Insert::findOrFail(1);
		$this->insert_header                     = $insert->insert_header;
		$this->header_status                     = $insert->header_status;
		$this->insert_body                       = $insert->insert_body;
		$this->body_status                       = $insert->body_status;
		$this->insert_footer                     = $insert->insert_footer;
		$this->footer_status                     = $insert->footer_status;

		$env                                     = new DotenvEditor();
		$this->remote_libreoffice                = $env->getValue("USE_REMOTE_LIBREOFFICE");
    }

    public function render()
    {

        //Meta
        $title = __('Advanced') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.advanced')->layout('layouts.admin', [
			'breadcrumbs' => [
			    ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
			    ['title' => __( 'Advanced' ), 'url' => null]
			]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdate
     * -------------------------------------------------------------------------------
    **/
    public function onUpdate()
    {
    	try {

			$insert                                    = Insert::findOrFail(1);
			$insert->insert_header                     = $this->insert_header;
			$insert->header_status                     = $this->header_status;
			$insert->insert_body                       = $this->insert_body;
			$insert->body_status                       = $this->body_status;
			$insert->insert_footer                     = $this->insert_footer;
			$insert->footer_status                     = $this->footer_status;

			$insert->updated_at                        = new DateTime();
			$insert->save();

	        $env = new DotenvEditor();
	        $env->changeEnv([
				'USE_REMOTE_LIBREOFFICE' => $this->remote_libreoffice
	        ]);

	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}
    }

}
