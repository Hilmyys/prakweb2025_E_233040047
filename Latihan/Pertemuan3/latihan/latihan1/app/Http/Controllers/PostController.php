<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category'])->latest()->get();
        
        return view('posts', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category']);

        return view('post', ['post' => $post]);
    }
}