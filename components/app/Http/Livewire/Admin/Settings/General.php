<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\General as GS;
use App\Models\Admin\Social;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Brotzka\DotenvEditor\DotenvEditor;
use Artesaos\SEOTools\Facades\SEOMeta;

class General extends Component
{

    protected $listeners                 = ['onSetParallaxImage'];

    public $separator;
    public $appname;
    public $parallax_status              = true;
    public $parallax_image;

    public $overlay_type                 = 'solid';
    public $solid_color                  = 'white';
    public $gradient_first_color         = 'white';
    public $gradient_second_color        = 'white';
    public $gradient_position            = 'to top';

    public $opacity                      = 0;
    public $blur                         = 0;

    //

    public $inputs                       = [];
    public $i                            = 1;
    public $name, $url;
    public $socials                      = [];

    public $font_family                  = 'Inter';
    public $timezone                     = 'UTC';
    public $font_style                   = 'regular';
    public $prefix                       = 'SumoWebTools_';
    public $file_size                    = '5';

    public $maintenance_mode             = false;
    public $theme_mode                   = true;
    public $default_theme_mode           = 'theme-light';
    public $dir_mode                     = false;
    public $adblock_detection            = true;
    public $automatic_language_detection = false;
    public $language_switcher            = true;
    public $page_load                    = true;
    public $lazy_loading                 = true;
    public $back_to_top                  = true;
    public $default_language             = 'en';
    public $main_color                   = '#ed3269';
    public $share_icons_status           = true;
    public $author_box_status            = true;
    public $search_box_status            = true;
    public $blog_page_status             = true;
    public $blog_page_count              = 6;
    public $related_tools                = true;
    public $related_tools_count          = 6;
    public $related_tools_background     = 'bg-teal';
    public $social_status                = true;
    public $icon_before_tool_name_status;
    public $featured_images_in_sidebar_status;

    public $google_fonts                 = [];
    public $timezones                    = [];

    public function mount()
    {
         $this->appname                           = env("APP_NAME");
         $this->separator                         = env("APP_SEPARATOR");

         $gs                                      = GS::findOrFail(1);

         $this->parallax_status                   = $gs->parallax_status;
         $this->parallax_image                    = $gs->parallax_image;
         $this->overlay_type                      = $gs->overlay_type;
         $this->solid_color                       = $gs->solid_color;
         $this->gradient_first_color              = $gs->gradient_first_color;
         $this->gradient_second_color             = $gs->gradient_second_color;
         $this->gradient_position                 = $gs->gradient_position;
         $this->opacity                           = $gs->opacity;
         $this->blur                              = $gs->blur;

         $this->font_family                       = $gs->font_family;
         $this->font_style                        = $gs->font_style;
         $this->prefix                            = $gs->prefix;
         $this->file_size                         = $gs->file_size;
         $this->timezone                          = $gs->timezone;
         $this->default_language                  = $gs->default_language;
         $this->main_color                        = $gs->main_color;

         $this->maintenance_mode                  = $gs->maintenance_mode;
         $this->theme_mode                        = $gs->theme_mode;
         $this->default_theme_mode                = $gs->default_theme_mode;
         $this->dir_mode                          = $gs->dir_mode;
         $this->adblock_detection                 = $gs->adblock_detection;
         $this->automatic_language_detection      = $gs->automatic_language_detection;
         $this->language_switcher                 = $gs->language_switcher;
         $this->page_load                         = $gs->page_load;
         $this->lazy_loading                      = $gs->lazy_loading;
         $this->back_to_top                       = $gs->back_to_top;
         $this->share_icons_status                = $gs->share_icons_status;
         $this->author_box_status                 = $gs->author_box_status;
         $this->search_box_status                 = $gs->search_box_status;
         $this->blog_page_status                  = $gs->blog_page_status;
         $this->blog_page_count                   = $gs->blog_page_count;
         $this->related_tools                     = $gs->related_tools;
         $this->related_tools_count               = $gs->related_tools_count;
         $this->related_tools_background          = $gs->related_tools_background;
         $this->social_status                     = $gs->social_status;
         $this->icon_before_tool_name_status      = $gs->icon_before_tool_name_status;
         $this->featured_images_in_sidebar_status = $gs->featured_images_in_sidebar_status;

         $this->socials                           = Social::all()->toArray();
         $this->i                                 = Social::all()->count();
         $this->google_fonts                      = Storage::disk('local')->get('google-fonts.json');
         $this->timezones                         = Storage::disk('local')->get('timezones.json');
    }

    public function render()
    {

        //Meta
        $title = __('General') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.general')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'General' ), 'url' => null]
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
		$this->reset(['name', 'url']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetParallaxImage
     * -------------------------------------------------------------------------------
    **/
    public function onSetParallaxImage($value)
    {
      $this->parallax_image = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  addSocial
     * -------------------------------------------------------------------------------
    **/
    public function addSocial($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

    /**
     * -------------------------------------------------------------------------------
     *  removeSocial
     * -------------------------------------------------------------------------------
    **/
    public function removeSocial($i)
    {
        unset($this->inputs[$i]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateGeneral
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateGeneral()
    {

        try {

            $env = new DotenvEditor();

            $env->changeEnv([
                'APP_TIMEZONE'  => $this->timezone,
                'APP_NAME'      =>  "'$this->appname'",
                'APP_SEPARATOR' =>  "'$this->separator'"
            ]);

            $gs                                    = GS::findOrFail(1);

            $gs->parallax_status                   = $this->parallax_status;
            $gs->parallax_image                    = $this->parallax_image;
            $gs->overlay_type                      = $this->overlay_type;
            $gs->solid_color                       = $this->solid_color;
            $gs->gradient_first_color              = $this->gradient_first_color;
            $gs->gradient_second_color             = $this->gradient_second_color;
            $gs->gradient_position                 = $this->gradient_position;
            $gs->opacity                           = $this->opacity;
            $gs->blur                              = $this->blur;

            $gs->font_family                       = $this->font_family;
            $gs->font_style                        = $this->font_style;
            $gs->prefix                            = $this->prefix;
            $gs->file_size                         = $this->file_size;
            $gs->timezone                          = $this->timezone;
            $gs->default_language                  = $this->default_language;
            $gs->main_color                        = $this->main_color;

            $gs->maintenance_mode                  = $this->maintenance_mode;
            $gs->theme_mode                        = $this->theme_mode;
            $gs->default_theme_mode                = $this->default_theme_mode;
            $gs->dir_mode                          = $this->dir_mode;
            $gs->adblock_detection                 = $this->adblock_detection;
            $gs->automatic_language_detection      = $this->automatic_language_detection;
            $gs->language_switcher                 = $this->language_switcher;
            $gs->page_load                         = $this->page_load;
            $gs->lazy_loading                      = $this->lazy_loading;
            $gs->back_to_top                       = $this->back_to_top;
            $gs->share_icons_status                = $this->share_icons_status;
            $gs->author_box_status                 = $this->author_box_status;
            $gs->search_box_status                 = $this->search_box_status;
            $gs->blog_page_status                  = $this->blog_page_status;
            $gs->blog_page_count                   = $this->blog_page_count;
            $gs->related_tools                     = $this->related_tools;
            $gs->related_tools_count               = $this->related_tools_count;
            $gs->related_tools_background          = $this->related_tools_background;
            $gs->social_status                     = $this->social_status;
            $gs->icon_before_tool_name_status      = $this->icon_before_tool_name_status;
            $gs->featured_images_in_sidebar_status = $this->featured_images_in_sidebar_status;
            $gs->updated_at                        = new DateTime();
            $gs->save();

            if ( $this->socials != null) {

                foreach ($this->socials as $key => $value) {
                    $usocial             = Social::findOrFail($value['id']);
                    $usocial->name       = $value['name'];
                    $usocial->url        = $value['url'];
                    $usocial->updated_at = new DateTime();
                    $usocial->save();
                }

            }

            if ( $this->name != null) {

                foreach ($this->name as $key => $value) {
                    $usocial             = new Social;
                    $usocial->name       = ($this->name[$key] == '') ? 'facebook' : $this->name[$key];
                    $usocial->url        = $this->url[$key];
                    $usocial->created_at = new DateTime();
                    $usocial->save();
                }
            }

            $this->inputs = [];
       
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteSocial
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteSocial($id)
    {
        try {

            $social = Social::findOrFail($id);
            $social->delete($id);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
