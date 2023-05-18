<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use App\Models\Posts\Post;
use App\Models\Posts\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::with('user', 'subject')->paginate(10);
        $posts = Post::with('user', 'subject')->latest()->paginate(request('perPage'));
        return  new PostCollection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)

    {

        // Auth::loginUsingId(1); //mengasign user secara langsung dengan mengambil id 1
        $posts = Auth::user()->posts()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'body' => $request->body,
            'subject_id' => $request->subject_id
        ]);

        return response()->json([
            'message' => ' post was created',
            'data' => $posts
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // if ($post->user_id !== auth()->id()) {
        //     abort(404);
        // }

        $this->authorize('update', $post);


        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'body' => $request->body,
            'subject_id' => $request->subject_id
        ]);

        // return response()->json([
        //     'message' => 'data was updated',
        // ], 200);

        return (new PostResource($post))->additional([
            'message' => 'Data was updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'data was deleted'
        ], 200);
    }
}
