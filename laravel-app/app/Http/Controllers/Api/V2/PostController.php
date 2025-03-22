<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::all();

        return new Response(['data' => $posts]);
    }

    public function view(int $id): Response
    {
        $post = Post::find($id);

        return new Response(['data' => $post]);
    }
}
