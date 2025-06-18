<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()) {
            return Post::query()->where('user_id', Auth::id())->paginate();
        }
        else {
            return Post::query()->paginate();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
            return Post::create([
                    'title'=> request('title'),
                    'slug'=> request('slug'),
                    'content'=> request('content'),
                    'user_id'=> Auth::id(),
                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StorePostRequest $storePostRequest,$post)
    {
        $post = $storePostRequest->route('post');
        if (Auth::user())
        {
            return response()->json(Post::query()->where('user_id', Auth::id())->findOrFail($post));
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $updatePostRequest, $post)
    {
        $post = $updatePostRequest->route('post');
        return Post::query()->where('user_id', Auth::id())->findOrFail($post)->update([
            'title'=> request('title'),
            'slug'=> request('slug'),
            'content'=> request('content'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdatePostRequest $updatePostRequest, $post)
    {
        $post = $updatePostRequest->route('post');
        return Post::query()->where('user_id', Auth::id())->findOrFail($post)->delete();
    }
}
