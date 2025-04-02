<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class DisclaimerGenerator extends Component
{

    public $company_name;
    public $website_url;
    public $email_address;
    public $data = [];
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.tools.disclaimer-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDisclaimerGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onDisclaimerGenerator()
    {

        $validationRules = [
            'company_name'  => 'required',
            'email_address' => 'required|email',
            'website_url'   => 'required|url'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

$disclaimer = '
<h1>Disclaimer for '.$this->company_name.'</h1>

<p>If you require any more information or have any questions about our site\'s disclaimer, please feel free to contact us by email at '.$this->email_address.'.</p>

<h2>Disclaimers for '.$this->company_name.'</h2>

<p>All the information on this website - '.$this->website_url.' - is published in good faith and for general information purpose only. '.$this->company_name.' does not make any warranties about the completeness, reliability, and accuracy of this information. Any action you take upon the information you find on this website ('.$this->company_name.'), is strictly at your own risk. '.$this->company_name.' will not be liable for any losses and/or damages in connection with the use of our website.</p>

<p>From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone \'bad\'.</p>

<p>Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.</p>

<h2>Consent</h2>

<p>By using our website, you hereby consent to our disclaimer and agree to its terms.</p>

<h2>Update</h2>

<p>Should we update, amend or make any changes to this document, those changes will be prominently posted here.</p>';

                $this->data['text'] = $disclaimer;

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {
            
            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Disclaimer Generator';
            $history->client_ip  = request()->ip();

            require app_path('Classes/geoip2.phar');

            $reader = new Reader( app_path('Classes/GeoLite2-City.mmdb') );

            try {

                $record           = $reader->city( request()->ip() );

                $history->flag    = strtolower( $record->country->isoCode );
                
                $history->country = strip_tags( $record->country->name );

            } catch (AddressNotFoundException $e) {
                
            }

            $history->created_at = new DateTime();
            $history->save();
        }

    }
}
