<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'movie_title',
        ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getReplyCountAttribute(): int
    {
        return $this->posts()->count();
    }

    public function latestPost()
    {
        return $this->posts()->latest()->first();
    }

    public function scopeWithTag($query, $tag)
    {
        return $query->whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->orWhere('movie_title', 'like', '%' . $search . '%');
    }
}
