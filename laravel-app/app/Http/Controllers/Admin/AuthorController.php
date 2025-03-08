<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::all();

        return view('admin.author.list', ['authors' => $authors]);
    }

    public function createView(): View
    {
        return view('admin.author.create');
    }

    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'avatar' => ['file', 'image', 'mimes:jpg', 'max:2048'],
        ]);

        if ($fields['avatar'] !== null) {
            $file = $request->file('avatar');
            $time = time();
            $avatar = public_path(). '/images/'. $time . '.jpg';
            $file->move(public_path().'/images/',$time .'.jpg');
            $fields['avatar'] = $avatar;
        }

        $author = new Author($fields);
        $author->save();

        return redirect('admin/authors');
    }

    public function updateView(int $id): View
    {
        $author = Author::find($id);

        return view('admin.author.update', ['author' => $author]);
    }

    public function update(int $id, Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'avatar' => ['file', 'image', 'mimes:jpg', 'max:2048'],
        ]);

        if ($fields['avatar'] !== null) {
            $file = $request->file('avatar');
            $time = time();
            $avatar = public_path(). '/images/'. $time . '.jpg';
            $file->move(public_path().'/images/',$time .'.jpg');
            $fields['avatar'] = $avatar;
        }

        $author = Author::find($id);
        $author->update($fields);

        return redirect('admin/authors');
    }

    public function delete(int $id)
    {
        $author = Author::find($id);

        File::delete($author->avatar);

        $author->delete();

        return redirect('admin/authors');
    }
}
