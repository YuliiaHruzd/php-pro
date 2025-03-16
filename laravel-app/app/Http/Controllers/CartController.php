<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $items = Cart::with('post')->get();

        return view('cart.list', ['items' => $items]);
    }

    public function create(int $postId)
    {
        (new Cart(['post_id' => $postId]))->save();

        return redirect('cart');
    }

    public function delete(int $id)
    {
        $item = Cart::find($id);

        $item->delete();

        return redirect('cart');
    }

    public function update(int $id, Request $request)
    {
        $item = Cart::find($id);

        $item->update(['count' => $request->get('count')]);

        return redirect('cart');
    }

    public function updateView(int $id): View
    {
        $item = Cart::find($id);

        return view('cart.update', ['item' => $item]);
    }
}
