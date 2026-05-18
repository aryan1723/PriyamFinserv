<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }

    public function blog()
    {
        $posts = \App\Models\BlogPost::latest()->get();
        return view('blog.index', compact('posts'));
    }

    public function showBlog($id)
    {
        $post = \App\Models\BlogPost::findOrFail($id);
        return view('blog_show', compact('post'));
    }
}
