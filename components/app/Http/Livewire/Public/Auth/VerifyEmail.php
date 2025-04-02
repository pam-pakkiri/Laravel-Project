<?php

namespace App\Http\Livewire\Public\Auth;

use Livewire\Component;
use App\Models\Admin\Advanced;
use App\Models\Admin\Advertisement;
use App\Models\Admin\AuthPages;
use App\Models\Admin\General;
use App\Models\Admin\Footer;
use App\Models\Admin\FooterTranslation;
use App\Models\Admin\Gdpr;
use App\Models\Admin\Header;
use App\Models\Admin\Menu;
use App\Models\Admin\Page as PublicPage;
use App\Models\Admin\Social;
use App\Models\Admin\User;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Rules\VerifyRecaptcha;

class VerifyEmail extends Component
{
    public $recaptcha;
    
    public function render()
    {
        $pageTrans = PublicPage::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'home')->get()->first();
        $general   = General::orderBy('id', 'DESC')->first();

        $url         = localization()->getLocalizedURL(app()->getLocale(), '/', [], false);
        $image       = $pageTrans->featured_image;
        $name        = config('app.name');

        switch ($general->maintenance_mode) {
            case true:
                    $title       = __('This site is undergoing maintenance!');
                    $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
                break;
            
            default:
                    $title       = __('Login') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
                    $description = $pageTrans->short_description;
                break;
        }

        //Meta
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');
        SEOMeta::addMeta('name', $description, 'itemprop');
        SEOMeta::addMeta('image', $image, 'itemprop');

        //Facebook
        OpenGraph::addProperty('type', 'website')
                                ->addProperty('locale', localization()->getCurrentLocaleRegional() )
                                ->addProperty('image:alt', $name)
                                ->setTitle($title)
                                ->setDescription($description)
                                ->setUrl($url)
                                ->setSiteName($name);

        //Twitter
        TwitterCard::setType('summary_large_image')
                            ->setImage($image)
                            ->setTitle($title)
                            ->setDescription($description)
                            ->setUrl($url);

        return view('livewire.public.auth.verify-email', [
            'general' => $general
        ])->layout('layouts.auth', [
            'page'          => PublicPage::where('type', 'home')->first(),
            'pageTrans'     => $pageTrans,
            'siteTitle'     => env('APP_NAME'),
            'general'       => $general,
            'profile'       => User::with('user_socials')->orderBy('id', 'DESC')->first(),
            'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
            'header'        => Header::orderBy('id', 'DESC')->first(),
            'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
            'notice'        => Gdpr::orderBy('id', 'DESC')->first(),
            'advanced'      => Advanced::orderBy('id', 'DESC')->first(),
            'advertisement' => Advertisement::orderBy('id', 'DESC')->first(),
            'socials'       => Social::orderBy('id', 'DESC')->get()->toArray()
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onResendEmail
     * -------------------------------------------------------------------------------
    **/
    public function onResendEmail()
    {

        $validationRules = [];

        if (General::first()->captcha_status) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

            auth()->user()->sendEmailVerificationNotification(); 

            session()->flash('status', 'success');
            session()->flash('message', __('A new verification link has been sent to the email address you provided during registration.'));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('Could not send verification link.'));
        }
        
    }

}
