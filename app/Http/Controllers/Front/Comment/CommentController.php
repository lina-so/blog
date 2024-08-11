<?php

namespace App\Http\Controllers\Front\Comment;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->comments()->create($request->validated());

        return redirect()->back()->with('success','comment added successfully');
    }

    /**
     * hide , show the specified resource.
     */
    public function hideComment(Comment $comment)
    {
        // $comment = Comment::findOrFail($comment);
        $comment->is_visible = false;
        $comment->save();

        return back()->with('error', 'Comment hidden successfully.');
    }

    public function showComment(Comment $comment)
    {
        // $comment = Comment::findOrFail($comment);
        $comment->is_visible = true;
        $comment->save();

        return back()->with('success', 'Comment shown successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('delete', 'comment deleted successfully.');
    }
}
