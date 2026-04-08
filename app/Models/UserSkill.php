<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $skill_name
 * @property string|null $skill_level
 * @property-read User $user
 */
class UserSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_name',
        'skill_level',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
