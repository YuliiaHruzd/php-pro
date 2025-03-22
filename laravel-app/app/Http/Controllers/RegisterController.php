<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function index(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name' => ['required'],
        ]);

        (new User($credentials))->save();

        return redirect('login');
    }
}
