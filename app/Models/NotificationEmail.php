<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationEmail extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'is_main', 'status'];

    public function markAsMain(): void
    {
        self::where('id', '<>', $this->id)->update(['is_main' => false]);
        $this->update(['is_main' => true]);
    }
}
