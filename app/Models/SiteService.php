<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class SiteService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'meta_title',
        'meta_description',
        'slug',
        'status',
        'parent_id',
        'quote'
    ];

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'quote_site_service')
                    ->using(QuoteSiteService::class);
    }

    public function parent()
    {
        return $this->belongsTo(SiteService::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SiteService::class, 'parent_id');
    }

    public function metadata()
    {
        return $this->morphMany(PolymorphicMetadata::class, 'metable');
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function faqs()
    {
        return $this->hasMany(\App\Models\ServiceFaq::class);
    }

    protected function pathServiceHome(): Attribute
    {
        return new Attribute(
            get: fn($value) => !empty($value) ? Storage::url($value) : null,
        );
    }

    protected function pathIcon(): Attribute
    {
        return new Attribute(
            get: fn($value) => !empty($value) ? Storage::url($value) : null,
        );
    }

    protected function pathFaqs(): Attribute
    {
        return new Attribute(
            get: fn($value) => !empty($value) ? Storage::url($value) : null,
        );
    }

    public function scopeSiteServiceFilter($search)
    {
        return $this->where('id', 'LIKE', '%'.$search.'%')
            ->orWhere('title', 'LIKE', '%'.$search.'%')
            ->orWhere('subtitle', 'LIKE', '%'.$search.'%');
    }

    
}
