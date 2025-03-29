<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;
use Srmklive\PayPal\Services\PayPal;

class PaypalService
{
    protected Paypal $payPal;

    public function __construct()
    {
        $this->payPal = app(abstract: PayPal::class);
        $this->payPal->setApiCredentials (credentials: config(key: 'paypal'));
        $this->payPal->setAccessToken (response: $this->payPal->getAccessToken());
    }

    public function create(Order $order, Collection $items)
    {
        $paypalOrder = $this->payPal->createOrder(
            data: $this->buildOrderRequestData(
                $order,
                $items
            )
        );

        Logs()->info('Paypal order created');

        return $paypalOrder;
    }

    public function capture($orderId)
    {
        $paypalCaptured = $this->payPal->capturePaymentOrder($orderId);

        Logs()->info('Paypal order captured');

        return $paypalCaptured;
    }

    public function buildOrderRequestData(Order $order, Collection $cartItems): array
    {
        $currencyCode = config(key: 'paypal.currency');
        $items = [];
        $cartItems
            ->each (callback: function ($item) use (&$items, $currencyCode) {
                $items[] = [
                    [
                        'name' => $item->name,
                        'quantity' => $item->qty,
                        'sku' => $item->post->sku,
                        'url' => url(path: route(name: 'post.show', parameters: $item->id)),
                        'category' => 'PHYSICAL_GOODS',
                        'unit_amount' => [
                            'currency_code' => $currencyCode,
                            'value' => $item->price,
                        ],
                        'tax' => [
                            'currency_code' => $currencyCode,
                            'value' => round(num: $item->price / 100 * $item->taxRate, precision: 2),
                        ],
                    ]
                ];
            });

        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $currencyCode,
                        'value' => $order->total,
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => $currencyCode,
                                'value' => $order->subtotal,
                            ],
                            'tax_total' => [
                                'currency_code' => $currencyCode,
                                'value' => $order->tax,
                            ],
                        ],
                    ],
                    'items' => $items
                ]
            ]
        ];
    }
}
