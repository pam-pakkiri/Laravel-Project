<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model implements TranslatableContract
{
    use Translatable, HasFactory, Sluggable;

    public $translatedAttributes = ['sitename_status', 'robots_meta', 'page_title', 'title', 'locale', 'subtitle', 'short_description', 'description'];
    protected $fillable          = ['slug', 'target', 'type', 'featured_image'];

    protected $table             = 'pages';
    protected $guarded           = [];

    protected $casts = [
        'post_status' => 'boolean',
        'page_status' => 'boolean',
        'tool_status' => 'boolean',
        'ads_status'  => 'boolean',
        'popular'     => 'boolean'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    public function page_categories() {
        return $this->belongsTo(PageCategory::class);
    }
}
