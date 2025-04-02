<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    use HasFactory;
    protected $table = 'sidebars';
    protected $guarded = [];
    protected $casts = [
        'tool_status' => 'boolean',
        'tool_sticky' => 'boolean',
        'post_status' => 'boolean',
        'post_sticky' => 'boolean'
    ];
}
