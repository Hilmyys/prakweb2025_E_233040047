<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::all();
        return view ('posts', com
    ('posts'));
    }
}
