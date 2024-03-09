<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specification',
        'status',
        'service',
        'range',
        'patio_size',
        'texture',
        'color',
        'normal_price',
        'total',
        'discount',
        'unit_price'
    ];

    protected $casts = [
        'created_at' => 'date:m-d-Y',
      ];
}
