<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'likes',
        'dislikes',
    ];

    //soft delete
    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [
        'likes',
        'dislikes',
    ];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
