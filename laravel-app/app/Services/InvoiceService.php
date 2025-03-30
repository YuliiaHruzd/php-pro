<?php

namespace App\Services;

use App\Email\InvoiceEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Facades\Invoice;

class InvoiceService
{
    public function create(Order $order)
    {
        $item = InvoiceItem::make('invoice')->pricePerUnit(2);

        $customer = new Buyer([
            'name' => Auth::user()->name,
        ]);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->totalAmount($order->total)
            ->totalTaxes($order->tax)
            ->addItem($item);

        $fileName = $order->id . '.pdf';
        Storage::put($fileName, $invoice->stream());
        $url = storage_path() . "/app/private/$fileName";

        Mail::to(Auth::user()->email)->send(new InvoiceEmail($url));
    }
}
