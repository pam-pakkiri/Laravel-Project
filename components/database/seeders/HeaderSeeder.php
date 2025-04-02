<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Header;
use DateTime;
class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Header::create(array(
              "id"            => 1,
              "logo_light"    => asset('assets/img/logo-light.svg'),
              "logo_dark"     => asset('assets/img/logo-dark.svg'),
              "favicon"       => asset('assets/img/favicon.png'),
              "sticky_header" => false,
              "header_style"  => 0,
              "created_at"    => new DateTime(),
              "updated_at"    => new DateTime()
          ));
    }
}
