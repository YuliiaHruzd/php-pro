<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('author')->get();

        return view('post.list', ['posts' => $posts]);
    }

    public function view(int $id): View
    {
        $post = Post::find($id);

        return view('post.view', ['post' => $post]);
    }
}
