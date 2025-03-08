<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();

        return view('admin.post.list', ['posts' => $posts]);
    }

    public function createView(): View
    {
        return view('admin.post.create');
    }

    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'text' => ['required', 'string'],
            'author_id' => ['required', 'int'],
        ]);

        (new Post($fields))->save();

        return redirect('admin/dashboard');
    }

    public function updateView(int $id): View
    {
        $post = Post::find($id);

        return view('admin.post.update', ['post' => $post]);
    }

    public function update(int $id, Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'text' => ['required', 'string'],
            'author_id' => ['required', 'int'],
        ]);
        $post = Post::find($id);
        $post->update($fields);

        return redirect('admin/dashboard');
    }

    public function delete(int $id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('admin/dashboard');
    }
}
