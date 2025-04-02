<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Sidebar;
use DateTime;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Sidebar::create(array(
            "id"              => 1,
            "post_status"     => true,
            "post_count"      => 6,
            "post_align"      => 'start',
            "post_background" => 'bg-teal',
            "tool_status"     => true,
            "tool_align"      => 'start',
            "tool_background" => 'bg-teal',
            "created_at"      => new DateTime(),
            "updated_at"      => new DateTime()
          ));
    }
}
