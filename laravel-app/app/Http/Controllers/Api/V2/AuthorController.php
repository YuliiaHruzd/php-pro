<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index(): Response
    {
        $authors = Author::all();

        return new Response(['data' => $authors]);
    }


    public function view(int $id): Response
    {
        $author = Author::find($id);

        return new Response(['data' => $author]);
    }
}
