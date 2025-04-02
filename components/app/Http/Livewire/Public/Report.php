<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Report as RP;
use DateTime;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class Report extends Component
{
    public $links;
    public $recaptcha;
    
    public function render()
    {
        return view('livewire.public.report');
    }

    /**
     * -------------------------------------------------------------------------------
     *  sendReport
     * -------------------------------------------------------------------------------
    **/
    public function sendReport()
    {

        $validationRules = [
            'links' => 'required',
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->links = preg_split('/\r\n|\r|\n/', $this->links);

        if ( count($this->links) > 0 ) {

            foreach ($this->links as $key => $value) {
                $report             = new RP;
                $report->link       = strip_tags(trim($value));
                $report->created_at = new DateTime();
                $report->save();
            }

            $this->links = null;

            $this->dispatchBrowserEvent('resetReCaptcha');

            session()->flash('status', 'success');
            session()->flash('message', __('Thanks for reporting issues to us. We will fix this issues as soon as possible.'));

        } else {

            $this->addError('404', __('Data not found!'));
        }
        
    }
}
