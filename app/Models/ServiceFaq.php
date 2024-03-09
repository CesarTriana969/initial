<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_service_id',
        'faq',
        'column_number',
        'answer'
    ];

    public function siteService()
    {
        return $this->belongsTo(App\Models\SiteService::class);
    }
}
