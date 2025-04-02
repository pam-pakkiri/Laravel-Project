<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Mailers\AppMailer;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class Contact extends Component
{
    public $name;
    public $email;
    public $message;
    public $recaptcha;

    public function render()
    {
        return view('livewire.public.contact');
    }

    /**
     * -------------------------------------------------------------------------------
     *  sendMessage
     * -------------------------------------------------------------------------------
    **/
    public function sendMessage(AppMailer $mailer)
    {

        $validationRules = [
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

            // Pass the form data instead of the validation rules
            $formData = [
                'name'    => $this->name,
                'email'   => $this->email,
                'message' => $this->message,
            ];

            $mailer->sendContactData($formData);

            $this->name    = null;
            $this->email   = null;
            $this->message = null;
            $this->dispatchBrowserEvent('resetReCaptcha');

            session()->flash('status', 'success');
            session()->flash('message', __('Thank you for your message. It has been sent!'));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
        }
    }
}
