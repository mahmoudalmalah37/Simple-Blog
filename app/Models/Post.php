<?php

namespace App\Models;

use App\Events\PostDeleteAuto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'views',
        'content',
        'image',
        'date',
        'comments',
        'likes',
        'dislike',
    ];

    protected $dates = ['deleted_at','date'];

    protected $casts = [
        'comments' => 'boolean',
        'likes' => 'boolean',
        'dislike' => 'boolean',
    ];

    protected $dispatchesEvents = [
        'deleted' => PostDeleteAuto::class,
    ];


    public function isLikedBy(?User $user): bool
    {
        return $user && (bool)$this->likes->where('user_id', $user->id)->where('like', 1)->count();
    }
    //isDislikedBy
    public function isDislikedBy(?User $user): bool
    {
        return $user && (bool)$this->dislike->where('user_id', $user->id)->where('like', 0)->count();
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }


}
