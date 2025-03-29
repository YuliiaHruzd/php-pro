<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Repositories\OrderRepository;
use App\Services\PaypalService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(private OrderRepository $orderRepository, private PaypalService $paypalService)
    {
    }

    public function create(): Response
    {
        $userId = Auth::user()->id;
        $cart = new Cart();
        $items = $cart->getItems($userId);
        $price = $items->sum('price');
        $tax = $items->sum(function (Cart $item) {
            return round(num: $item->price / 100 * $item->tax_rate, precision: 2);
        });
        $total = $items->sum(function (Cart $item) {
            return round(num: $item->price / 100 * $item->tax_rate, precision: 2) + $item->price;
        });

        $order = $this->orderRepository->create([
            'user_id' => $userId,
            'total' => $total,
            'tax' => $tax,
            'subtotal' => $price,
        ]);

        $response = $this->paypalService->create($order, $items);

        return new Response($response);
    }

    public function capture(int $postId)
    {
        $response = $this->paypalService->capture($postId);

        return new Response($response);
    }
}
