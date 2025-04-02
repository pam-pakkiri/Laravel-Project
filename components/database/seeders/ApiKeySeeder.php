<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ApiKeys;
use Illuminate\Support\Str;
use DateTime;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $api_key = ApiKeys::create(array(
            "id"         => 1,
            "created_at" => new DateTime()
        ));

        $indexnow_api_key = (string) Str::uuid();
        $indexnow_api_key = str_replace('-', '', $indexnow_api_key);
        
        $api_key->indexnow_api_key = $indexnow_api_key;
        $api_key->updated_at = new DateTime();
        $api_key->save();
    }
}
