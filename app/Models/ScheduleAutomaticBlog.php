<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleAutomaticBlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'keyword',
    ];
}
