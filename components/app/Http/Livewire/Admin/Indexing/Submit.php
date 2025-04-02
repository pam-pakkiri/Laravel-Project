<?php

namespace App\Http\Livewire\Admin\Indexing;

use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\InstantIndexingHistory;
use App\Models\Admin\ApiKeys;

class Submit extends Component
{

    protected $apiUrl = 'https://api.indexnow.org/indexnow/';
    protected $apiKey;
    protected $host;
    public $urls;

    public function render()
    {
        //Meta
        $title = __('Submit URLs') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.indexing.submit')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Instant Indexing' ), 'url' => null],
                ['title' => __( 'Submit URLs' ), 'url' => null]
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
        $this->reset(['urls']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_host
     * -------------------------------------------------------------------------------
    **/
    public function get_host() {
        $host = parse_url( route('home'), PHP_URL_HOST );
        if ( empty( $host ) ) {
            $host = 'localhost';
        }

        return $host;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSubmitURLs
     * -------------------------------------------------------------------------------
    **/
    public function onSubmitURLs()
    {

        try {

                $urlsArray = explode("\n", $this->urls);

                $payload = [
                    'host'    => $this->get_host(),
                    'key'     => ApiKeys::first()->indexnow_api_key,
                    'urlList' => (array) $urlsArray,
                ];

                $response = Http::post($this->apiUrl, $payload);

                // Save the log
                foreach ($urlsArray as $url) {
                    InstantIndexingHistory::create([
                        'url'      => $url,
                        'response' => $response->status(),
                    ]);
                }

                if ( in_array( $response->status(), [ 200, 202, 204 ], true ) ) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data submitted successfully!') ]);
                    $this->resetInputFields();
                    return;
                }
                
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Failed to submit URLs. See details in the History tab.') ]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
