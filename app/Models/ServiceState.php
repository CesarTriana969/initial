<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceState extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abv', 'slug'];

    public function counties(){
        return $this->hasMany(ServiceCounty::class);
    }
}
