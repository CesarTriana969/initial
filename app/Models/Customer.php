<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'company_name', 'birth_day', 'address', 'apt', 'city','state', 'zip_code'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
