<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\General;
use DateTime;
class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          General::create(array(
            "id"                           => 1,
            "parallax_status"              => true,
            "parallax_image"               => asset('assets/img/parallax.jpg'),
            "overlay_type"                 => "gradient",
            "solid_color"                  => "#ed3269",
            "gradient_first_color"         => "#ed3269",
            "gradient_second_color"        => "#f05f3e",
            "gradient_position"            => "to left",
            "opacity"                      => "0.9",
            "blur"                         => "1",
            "font_family"                  => "Inter",
            "font_style"                   => "regular",
            "prefix"                       => "SumoWebTools_",
            "file_size"                    => "5",
            "timezone"                     => "UTC",
            "default_language"             => "en",
            "main_color"                   => "#cb0c9f",
            "maintenance_mode"             => false,
            "theme_mode"                   => true,
            "dir_mode"                     => 1,
            "adblock_detection"            => true,
            "automatic_language_detection" => false,
            "language_switcher"            => true,
            "page_load"                    => true,
            "lazy_loading"                 => true,
            "back_to_top"                  => true,
            "share_icons_status"           => true,
            "search_box_status"            => true,
            "author_box_status"            => true,
            "social_status"                => true,
            "blog_page_status"             => true,
            "blog_page_count"              => "6",
            "related_tools"                => true,
            "related_tools_count"          => "6",
            "related_tools_background"     => "bg-teal",
            "created_at"                   => new DateTime(),
            "updated_at"                   => new DateTime()
          ));
    }
}
