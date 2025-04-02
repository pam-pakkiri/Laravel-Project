<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    use HasFactory;

    protected $table = 'page_categories';
    protected $guarded = [];

    public function pages() {
        return $this->hasMany(Page::class, 'category_id')->where('tool_status', true)->orderBy('position', 'ASC');
    }
}
