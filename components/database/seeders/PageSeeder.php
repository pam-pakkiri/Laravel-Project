<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use File, DateTime;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = File::get('components/database/contents/pages.json');

        $pages = json_decode($pages);
        
        foreach ($pages as $page) {

          switch ( $page->type ) {

            case 'tool':

                Page::create(array(
                          "id"               => $page->id,
                          "slug"             => $page->slug,
                          "type"             => 'tool',
                          "featured_image"   => asset('assets/img/nastuh.jpg'),
                          "tool_name"        => $page->tool_name,
                          "icon_image"       => asset('assets/img/tools/' . $page->icon_image),
                          "ads_status"       => $page->ads_status,
                          "popular"          => $page->popular,
                          "position"         => $page->position,
                          "category_id"      => $page->category_id,
                          "post_status"      => true,
                          "page_status"      => true,
                          "tool_status"      => true,
                          "custom_tool_link" => $page->custom_tool_link,
                          "created_at"       => new DateTime(),
                          "updated_at"       => new DateTime()
                    ));

                foreach ($page->translations as $pageTran) {

                     PageTranslation::create([
                        "locale"            => $pageTran->locale,
                        "page_title"        => $pageTran->title,
                        "title"             => $pageTran->title,
                        "subtitle"          => '',
                        "short_description" => $pageTran->title,
                        "description"       => '',
                        "page_id"           => $page->id
                    ]);

                }

              break;

            default:

                Page::create(array(
                      "id"               => $page->id,
                      "slug"             => $page->slug,
                      "type"             => $page->type,
                      "featured_image"   => asset('assets/img/nastuh.jpg'),
                      "tool_name"        => null,
                      "ads_status"       => $page->ads_status,
                      "popular"          => $page->popular,
                      "category_id"      => null,
                      "post_status"      => true,
                      "page_status"      => true,
                      "tool_status"      => true,
                      "custom_tool_link" => $page->custom_tool_link,
                      "created_at"       => new DateTime(),
                      "updated_at"       => new DateTime()
                ));

                foreach ($page->translations as $pageTran) {

                     PageTranslation::create([
                        "locale"            => $pageTran->locale,
                        "page_title"        => $pageTran->title,
                        "title"             => $pageTran->title,
                        "subtitle"          => $pageTran->subtitle,
                        "short_description" => $pageTran->title,
                        "description"       => '',
                        "page_id"           => $page->id
                    ]);

                }

              break;
          }

        }
    }
}
