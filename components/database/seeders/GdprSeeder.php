<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Gdpr;
use DateTime;
class GdprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Gdpr::create(array(
            "id"         => 1,
            "notice"     => "We care about your data and would love to use cookies to improve your experience.",
            "align"      => "text-center",
            "background" => "bg-white",
            "button"     => 1,
            "status"     => true,
            "created_at" => new DateTime(),
            "updated_at" => new DateTime()
          ));
    }
}
