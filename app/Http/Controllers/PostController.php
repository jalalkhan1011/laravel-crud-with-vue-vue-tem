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
        return response(['status'=>'success','posts' => $posts, 'code' => '200']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post = Post::create($request->all());
        return response(['status'=>'success','post' => $post, 'code' => '200']);
    }
}
