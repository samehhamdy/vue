<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = new Post([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        $post->save();

        return response()->json($post);
    }

    public function index()
    {
        return new PostCollection(Post::orderBy('created_at','desc')->get());
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);

        $post->update($request->all());

        return response()->json('successfully updated');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        $posts = Post::orderBy('created_at','desc')->get();

        return response()->json($posts);
    }
}
