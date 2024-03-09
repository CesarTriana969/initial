<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_key', 'fileable_id', 'fileable_type', 'file_path'];

    public function fileable() {
        return $this->morphTo();
    }
    
    public function metadatas() {
        return $this->morphMany(PolymorphicMetadata::class, 'metable');
    }

    public function getFilePathAttribute($attribute)
    {
        $url = $this->attributes['file_path'];
            return env('APP_URL') . '/storage/' . $url;
    }

    public function getFileWithoutDomainAttribute($attribute)
    {
        $url = $this->attributes['file_path'];
        return '/' . $url;
    }

}
