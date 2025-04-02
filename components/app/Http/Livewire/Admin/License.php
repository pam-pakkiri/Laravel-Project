<?php

namespace App\Http\Livewire\Admin;

use App\Models\Install;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use DateTime;

class License extends Component
{

    public $purchase_code;
    public $domain;

    public function mount()
    {
        $this->purchase_code = Install::findOrFail(1)->first()->token;
        $this->domain = $this->getDomainFromUrl( env('APP_URL') );
    }

    public function render()
    {
        //Meta
        $title = __('License') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.license')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'License' ), 'url' => null]
            ]
        ]);

    }

    /**
     * -------------------------------------------------------------------------------
     *  getDomainFromUrl
     * -------------------------------------------------------------------------------
    **/
    public function getDomainFromUrl($url)
    {
        $parsedUrl = parse_url($url);

        if (isset($parsedUrl['host'])) {
            return $parsedUrl['host'];
        }

        return null; // Return null if the domain is not found
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateDatabase
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateLicense()
    {
		$data             = Install::findOrFail(1);
		$data->token      = $this->purchase_code;
		$data->updated_at = new DateTime();
		$data->save();

		$this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The license has been updated successfully!') ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onResetLicense
     * -------------------------------------------------------------------------------
    **/
    public function onResetLicense($purchase_code, $domain)
    {

        $this->purchase_code = Install::findOrFail(1)->first()->token;
        $this->domain        = $this->getDomainFromUrl( env('APP_URL') );

		$data             = Install::findOrFail(1);
		$data->token      = null;
		$data->updated_at = new DateTime();
		$data->save();
		return response()->json(['status' => 'success'], 200);
    }

}
