<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response(['status' => 'success', 'posts' => $posts, 'code' => '200']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post = Post::create($request->all());
        return response(['status' => 'success', 'post' => $post, 'code' => '200']);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response(['status' => 'success', 'post' => $post, 'code' => '200']);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post->update($request->all());
        return response(['status' => 'success', 'post' => $post, 'code' => '200']);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(['status' => 'success', 'post' => $post, 'code' => '200']);
    }
}
