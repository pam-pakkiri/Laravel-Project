<?php
namespace App\Mailers;

use Illuminate\Contracts\Mail\Mailer;
use App\Models\Admin\Page;
use App\Models\Admin\User;
use Auth;

class AppMailer {
    protected $mailer; 
    protected $fromAddress;
    protected $fromName;
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject)->replyTo($this->email, $this->subject);
        });
    }

    public function sendContactData($data)
    {
        
        $this->fromAddress = env("MAIL_FROM_ADDRESS");
        $this->fromName    = Page::where('type', 'home')->first()->title;
        $this->to          = env("MAIL_TO_ADDRESS");
        $this->subject     = "New message from " . $data['email'];
        $this->email       = $data['email'];
        $this->view        = 'livewire.public.mail';
        $this->data        = compact('data');

        return $this->deliver();
    }

}
?>