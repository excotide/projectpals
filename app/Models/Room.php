<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Room extends Model
{
    protected $table = 'room';

    protected $fillable = ['name', 'description', 'code', 'creator_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($room) => $room->code = strtoupper(Str::random(8)));
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
