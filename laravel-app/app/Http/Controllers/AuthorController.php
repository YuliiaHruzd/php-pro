<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::with('post')->get();

        return view('author.list', ['authors' => $authors]);
    }


    public function view(int $id): View
    {
        $author = Author::find($id);

        return view('admin.author.update', ['author' => $author]);
    }
}
