<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreeRoot extends Model
{
    use HasFactory;

    protected $fillable = [
        'tree',
        'root',
        'level',
        'parent_order',
        'order',
        'grandfather_order',
    ];
}
