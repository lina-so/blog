<?php

namespace App\Http\Controllers\Dashboard\Post;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;

class PostController extends Controller
{
/***********************************************************************************************************/

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $post = Post::find(2)->getFirstMedia('images')->getUrl();
        // dd($post);
        //http://localhost/storage/1/302104871_1112472889358287_7601329894455719647_n.jpg
        $posts = Post::with('blogs','comments')->paginate();
        $post = new Post();

        return view('pages.posts.index',compact('posts','post'));

    }
/***********************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

/***********************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return $this->updateOrCreate($request, null, 'create');
    }

/***********************************************************************************************************/

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('pages.posts.show',compact('post'));
    }
/***********************************************************************************************************/

    public function updateBlog(Request $request,Post $post)
    {
        $post->blogs()->sync($request->input('blogs'));
        return redirect()->back();

    }
/***********************************************************************************************************/

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
/***********************************************************************************************************/

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        return $this->updateOrCreate($request, $post, 'update');

    }
/***********************************************************************************************************/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('delete', 'Post deleted successfully.');
    }
/***********************************************************************************************************/
    public function updateOrCreate(PostRequest $request, Post $post = null, $method = 'create')
    {
        // dd($request)
        if($method === 'create'){
            $post = Post::create($request->validated());

            if($request->hasFile('image'))
            {
                $post->addMediaFromRequest('image')->toMediaCollection('images');
            }
        }else{
            $post->update($request->validated());

            if($request->hasFile('image'))
            {
                if($post->hasMedia('images'))
                {
                    $post->clearMediaCollection('images');
                }
                $post->addMediaFromRequest('image')->toMediaCollection('images');
            }
        }

        $this->attach_blogs($post, $request);

        $message = $method === 'create' ? 'Post created successfully.' : 'Post updated successfully.';
        return redirect()->route('post.index')->with($method === 'create' ? 'success' : 'update', $message);
    }
/***********************************************************************************************************/

    public function attach_blogs($post,$request)
    {
        return $post->blogs()->sync($request->input('blogs'));
    }
}
