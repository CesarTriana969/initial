<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailValidation extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = ['email', 'code', 'user_id', 'expires_at'];
}
