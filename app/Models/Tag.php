<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }

    public function getTopicCountAttribute(): int
    {
        return $this->topics()->count();
    }
}
