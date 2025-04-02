<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthPages extends Model
{
    use HasFactory;
    protected $table = 'auth_pages';
    protected $guarded = [];
    protected $casts = [
        'status'      => 'boolean',
    ];
}
