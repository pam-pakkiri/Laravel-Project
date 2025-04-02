<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstantIndexingHistory extends Model
{
    use HasFactory;
    protected $table = 'instant_indexing_histories';
    protected $guarded = [];
}
