<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function siteServices()
    {
        return $this->belongsToMany(SiteService::class, 'quote_site_service')->withPivot('id');
    }
}
