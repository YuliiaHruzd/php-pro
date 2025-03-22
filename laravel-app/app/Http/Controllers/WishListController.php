<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishListController extends Controller
{
    public function index(): View
    {
        $wishList = WishList::class::with(['post'], 'user')->get();

        return view('wish-list.list', ['wishList' => $wishList]);
    }

    public function create(int $postId)
    {
        (new WishList(['post_id' => $postId, 'user_id' => Auth::getUser()->id]))->save();

        return redirect('wish-list');
    }

    public function delete(int $id)
    {
        $item = WishList::find($id);

        $item->delete();

        return redirect('wish-list');
    }
}
