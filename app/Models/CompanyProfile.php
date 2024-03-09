<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'phone_number', 
        'fax', 
        'instagram', 
        'facebook', 
        'email',
        'microsoft_access_token'
    ];
}
