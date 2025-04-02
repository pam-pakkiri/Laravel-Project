<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = 'advertisements';
    
    protected $guarded = [];

    protected $casts = [
        'area1_status'          => 'boolean',
        'area2_status'          => 'boolean',
        'area3_status'          => 'boolean',
        'area4_status'          => 'boolean',
        'area5_status'          => 'boolean',
        'sidebar_top_status'    => 'boolean',
        'sidebar_middle_status' => 'boolean',
        'sidebar_bottom_status' => 'boolean'
    ];
}
