<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Brotzka\DotenvEditor\DotenvEditor;
use Artesaos\SEOTools\Facades\SEOMeta;

class Smtp extends Component
{
	public $host;
	public $port;
	public $username;
	public $password;
	public $encryption = 'tls';
	public $mail_from_address;
	public $mail_to_address;
	
	public function mount()
	{
		$this->mail_from_address = env("MAIL_FROM_ADDRESS");
		$this->mail_to_address   = env("MAIL_TO_ADDRESS");
		$this->host              = env("MAIL_HOST");
		$this->port              = env("MAIL_PORT");
		$this->username          = env("MAIL_USERNAME");
		$this->password          = env("MAIL_PASSWORD");
		$this->encryption        = env("MAIL_ENCRYPTION");
	}

    public function render()
    {

        //Meta
        $title = __('SMTP') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.smtp')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'SMTP' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateSMTP
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateSMTP(){

    	try {

	        $env = new DotenvEditor();

	        $env->changeEnv([
				'MAIL_HOST'         => $this->host,
				'MAIL_PORT'         => $this->port,
				'MAIL_USERNAME'     => $this->username,
				'MAIL_PASSWORD'     => "'$this->password'",
				'MAIL_ENCRYPTION'   => $this->encryption,
				'MAIL_TO_ADDRESS'   => $this->mail_to_address,
				'MAIL_FROM_ADDRESS' => $this->mail_from_address
	        ]);

	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
        
    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}

    }
}
