<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'catalogue_id',
        'title',
        'slug',
        'user_id',
        'thumbnail',
        'excerpt',
        'content',

        'views',
        'is_active',
        'deleted'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'deleted' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
