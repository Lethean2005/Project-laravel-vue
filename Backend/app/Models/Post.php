<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('title', 'content');
        if ($id) {
            $post = self::find($id);
            $post->update($data);
        } else {
            $post = self::create($data);
        }
        return $post;
    }

    public function getDateAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return $date->isoFormat('Do MMMM');
    }
}
