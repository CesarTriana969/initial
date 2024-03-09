<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCounty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'service_state_id'];

    public function state(){
        return $this->belongsTo(ServiceState::class);
    }
}
