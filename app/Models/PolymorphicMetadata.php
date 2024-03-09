<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolymorphicMetadata extends Model
{
    use HasFactory;

    protected $table = 'polymorphic_metadata';
    protected $fillable = ['meta_key', 'meta_value'];

    public function metable()
    {
        return $this->morphTo();
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }
}
