<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'publication_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'date',
    ];

    /**
     * Get the user that created the news item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full URL for the news image.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    /**
     * Get a short excerpt of the content.
     */
    public function getExcerptAttribute(): string
    {
        return strlen($this->content) > 150
            ? substr($this->content, 0, 150) . '...'
            : $this->content;
    }
}
