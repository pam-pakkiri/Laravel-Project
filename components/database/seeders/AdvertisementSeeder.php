<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Advertisement;
use DateTime;
class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Advertisement::create(array(
              "id"                    => 1,
              "area1"                 => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
              "area1_status"          => false,
              "area1_align"           => "center",
              "area1_margin"          => "10",
              "area2"                 => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
              "area2_status"          => false,
              "area2_align"           => "center",
              "area2_margin"          => "10",
              "area3"                 => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
              "area3_status"          => false,
              "area3_align"           => "center",
              "area3_margin"          => "10",
              "area4"                 => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
              "area4_status"          => false,
              "area4_align"           => "center",
              "area4_margin"          => "10",
              "area5"                 => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
              "area5_status"          => false,
              "area5_align"           => "center",
              "area5_margin"          => "10",
              "sidebar_top"           => '<img class="img-fluid" src="'.asset('assets/img/300x250.png').'">',
              "sidebar_top_status"    => false,
              "sidebar_top_align"     => "center",
              "sidebar_top_margin"    => "0",
              "sidebar_middle"        => '<img class="img-fluid" src="'.asset('assets/img/300x250.png').'">',
              "sidebar_middle_status" => false,
              "sidebar_middle_align"  => "center",
              "sidebar_middle_margin" => "0",
              "sidebar_bottom"        => '<img class="img-fluid" src="'.asset('assets/img/300x600.png').'">',
              "sidebar_bottom_status" => false,
              "sidebar_bottom_align"  => "center",
              "sidebar_bottom_margin" => "0",
              "created_at"            => new DateTime(),
              "updated_at"            => new DateTime()
          ));
    }
}
