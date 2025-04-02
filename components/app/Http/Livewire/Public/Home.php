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
use App\Models\Admin\PageCategory;

class Home extends Component
{
    public $searchQuery = '';
    
    public function render()
    {

        try {

            $pageTrans = PublicPage::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'home')->get()->first();
            $general   = General::first();

            $url         = localization()->getLocalizedURL(app()->getLocale(), '/', [], false);
            $image       = $pageTrans->featured_image;
            $name        = config('app.name');

            switch ($general->maintenance_mode) {
                case true:
                        $title       = __('This site is undergoing maintenance!');
                        $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
                    break;
                
                default:
                        $title       = $pageTrans->page_title;
                        $description = $pageTrans->short_description;
                    break;
            }

            //Meta
            $siteName = $pageTrans->sitename_status ? ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME') : '';
            SEOMeta::setTitle($title . $siteName);
            SEOMeta::setDescription($description);
            SEOMeta::setCanonical($url);
            if ( $pageTrans->robots_meta ) {
                SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');
            }
            else SEOMeta::addMeta('robots', 'noindex, follow', 'name');

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

            $tool_with_categories = PageCategory::with(['pages' => function ($query) {
                                        $query->withTranslation( app()->getLocale() );
                                    }])->orderBy('sort', 'ASC')->get()
                                    ->transform(function ($category) {
                                        $category->setRelation('pages', $category->pages->map(function ($page) {
                                            $translatedPage = $page->translate( app()->getLocale() );
                                            if ($translatedPage) {
                                                $translatedPage->slug             = $page->slug;
                                                $translatedPage->target           = $page->target;
                                                $translatedPage->icon_image       = $page->icon_image;
                                                $translatedPage->custom_tool_link = $page->custom_tool_link;
                                            }
                                            return $translatedPage;
                                        })->filter());

                                        return $category;

                                    })->filter()->toArray();

            $tools = PublicPage::where('type', 'tool')
                                ->where('tool_status', true)
                                ->orderBy('position', 'ASC')
                                ->get()
                                ->map(function ($page) {
                                    return $page->translate( app()->getLocale() );
                                })->filter()->toArray();

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

            $page = PublicPage::where('type', 'home')->first();
            
            $advertisement = Advertisement::first();

            $advanced = Advanced::first();

            return view('livewire.public.home', [
                'general'              => $general,
                'tool_with_categories' => $tool_with_categories,
                'tools'                => $tools,
                'page'                 => $page,
                'advertisement'        => $advertisement
            ])->layout('layouts.public', [
                'page'          => $page,
                'pageTrans'     => $pageTrans,
                'general'       => $general,
                'profile'       => User::with('user_socials')->where('is_admin', true)->first(),
                'advertisement' => $advertisement,
                'sidebar'       => Sidebar::first(),
                'recent_posts'  => $recent_posts,
                'popular_tools' => $popular_tools,
                'siteTitle'     => env('APP_NAME'),
                'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
                'header'        => Header::first(),
                'advanced'      => $advanced,
                'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
                'socials'       => Social::orderBy('id', 'ASC')->get()->toArray(),
                'notice'        => Gdpr::first()
            ]);

        } catch (\Exception $e) {
            return view('livewire.public.install.welcome')->layout('layouts.install');
        }
    }
}
