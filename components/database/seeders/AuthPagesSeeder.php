<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File, DateTime;
use App\Models\Admin\AuthPages;

class AuthPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authpages = File::get('components/database/contents/authpages.json');

        $authpages = json_decode($authpages);
        
        foreach ($authpages as $authpage) {

          AuthPages::create(array(
            "id"         => $authpage->id,
            "name"       => $authpage->name,
            "status"     => $authpage->status,
            "created_at" => new DateTime(),
            "updated_at" => new DateTime()
          ));
          
        }
    }
}
