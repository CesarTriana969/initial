<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class QuoteSiteService extends Pivot
{
    use HasFactory;

    protected $fillable = ['meta_key', 'meta_value'];

    public function metadatable()
    {
        return $this->morphMany(PolymorphicMetadata::class, 'metable');
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }
}
