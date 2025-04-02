<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            TranslationSeeder::class,
            DashboardSeeder::class,
            SidebarSeeder::class,
            PageCategorySeeder::class,
            PageSeeder::class,
            GeneralSeeder::class,
            MenuSeeder::class,
            HeaderSeeder::class,
            FooterSeeder::class,
            GdprSeeder::class,
            AdvertisementSeeder::class,
            AdvancedSeeder::class,
            SocialSeeder::class,
            AuthPagesSeeder::class,
            ApiKeySeeder::class,
        ]);
    }
}
