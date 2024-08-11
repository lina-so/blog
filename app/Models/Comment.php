<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable= ['post_id','author_name','content','is_visible'];



    protected static function boot()
    {
        parent::boot();
        static::creating(function ($comment) {
            return DB::transaction(function () use ($comment) {
                $comment->author_name = Auth::user()->name;
            });

        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
