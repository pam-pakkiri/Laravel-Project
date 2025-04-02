<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;

    protected $table    = 'page_translations';
    protected $guarded  = [];

    public $timestamps  = false;

    protected $fillable = ['sitename_status', 'robots_meta', 'page_title', 'title', 'subtitle', 'short_description', 'description'];
}
