<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use App\Models\Admin\History;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          History::create(array(
            "id"         => 1,
            "tool_name"  => "Find Facebook ID",
            "client_ip"  => "127.0.0.1",
            "country"    => null,
            "flag"       => null,
            "updated_at" => new DateTime(),
            "created_at" => new DateTime()
          ));
    }
}
