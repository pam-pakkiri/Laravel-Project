<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File, DateTime;
use App\Models\Admin\PageCategory;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cates = File::get('components/database/contents/pagecategory.json');

        $cates = json_decode($cates);
        
        foreach ($cates as $cate) {

          PageCategory::create(array(
                "id"          => $cate->id,
                "title"       => $cate->title,
                "description" => $cate->description,
                "sort"        => $cate->sort,
                "align"       => $cate->align,
                "background"  => $cate->background,
                "created_at"  => new DateTime(),
                "updated_at"  => new DateTime()
          ));

        }
    }
}
