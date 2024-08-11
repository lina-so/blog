<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    protected $fillable= ['title','content','status','user_id'];

    protected $hidden = [
        'deleted_at',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            return DB::transaction(function () use ($post) {
                $post->user_id = Auth::user()->id;
            });

        });

        static::updating(function ($post) {
            return DB::transaction(function () use ($post) {
                $post->user_id = Auth::user()->id;
            });

        });
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
