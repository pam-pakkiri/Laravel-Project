<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Page as PublicPage;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

use App\Models\Admin\General;
use App\Models\Admin\Social;
use App\Models\Admin\User;
use App\Models\Admin\Menu;
use App\Models\Admin\Header;
use App\Models\Admin\Footer;
use App\Models\Admin\Gdpr;
use App\Models\Admin\Advanced;
use App\Models\Admin\Advertisement;
use App\Models\Admin\FooterTranslation;
use App\Models\Admin\Redirect;
use App\Models\Admin\Sidebar;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $pageTrans     = PublicPage::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'post')->where('post_status', true)->orderByTranslation('id', 'DESC')->paginate( General::first()->blog_page_count );
        $page          = PublicPage::where('type', 'home')->first();
        $general       = General::orderBy('id', 'DESC')->first();

        if ( !empty($pageTrans) ) {

                $url         = localization()->getLocalizedURL(app()->getLocale(), '/blog', [], false);
                $image       = $page->featured_image;
                $name        = config('app.name');

                switch ($general->maintenance_mode) {
                    case true:
                            $title       = __('This site is undergoing maintenance!');
                            $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
                        break;
                    
                    default:
                            $title       = __('Our Blog');
                            $description = __('Stay up to date with the latest news');
                        break;
                }

                //Meta
                $siteName = ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
                SEOMeta::setTitle($title . $siteName);
                SEOMeta::setDescription($description);
                SEOMeta::setCanonical($url);
                SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');
                
                //Facebook
                OpenGraph::addProperty('type', 'article')
                                        ->addProperty('locale', localization()->getCurrentLocaleRegional() )
                                        ->addImage($image)
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

            $recent_posts = PublicPage::where('type', 'post')
                                ->where('post_status', true)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->map(function ($page) {
                                    $translatedPage = $page->translate( app()->getLocale() );
                                    if ($translatedPage) {
                                        $translatedPage->slug           = $page->slug;
                                        $translatedPage->target         = $page->target;
                                        $translatedPage->featured_image = $page->featured_image;
                                    }
                                    return $translatedPage;
                                })->take( Sidebar::first()->tool_count )->filter()->toArray();

            $popular_tools = PublicPage::where('type', 'tool')
                                ->where('popular', true)
                                ->where('tool_status', true)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->map(function ($page) {
                                    $translatedPage = $page->translate( app()->getLocale() );
                                    if ($translatedPage) {
                                        $translatedPage->slug             = $page->slug;
                                        $translatedPage->target           = $page->target;
                                        $translatedPage->custom_tool_link = $page->custom_tool_link;
                                    }
                                    return $translatedPage;
                                })->take( Sidebar::first()->tool_count )->filter()->toArray();

            return view('livewire.public.blog', [
                'page'      => $page,
                'general'   => $general,
                'pageTrans' => $pageTrans
            ])->layout('layouts.blog', [
                'page'          => $page,
                'pageTrans'     => $pageTrans,
                'general'       => $general,
                'profile'       => User::with('user_socials')->where('is_admin', true)->orderBy('id', 'DESC')->first(),
                'advertisement' => Advertisement::orderBy('id', 'DESC')->first(),
                'sidebar'       => Sidebar::orderBy('id', 'DESC')->first(),
                'recent_posts'  => $recent_posts,
                'popular_tools' => $popular_tools,
                'siteTitle'     => env('APP_NAME'),
                'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
                'header'        => Header::orderBy('id', 'DESC')->first(),
                'advanced'      => Advanced::orderBy('id', 'DESC')->first(),
                'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
                'socials'       => Social::orderBy('id', 'ASC')->get()->toArray(),
                'notice'        => Gdpr::orderBy('id', 'DESC')->first()
            ]);
        
        } else abort(404);
    }

}
