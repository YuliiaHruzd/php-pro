<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function all(): Collection
    {
        return Order::all();
    }

    public function create(array $data): ?Order
    {
        return Order::create($data);
    }

    public function update(array $data, int $id): int
    {
        $user = Order::findOrFail($id);

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = Order::findOrFail($id);

        return $user->delete();
    }

    public function find(int $id): ?Order
    {
        return Order::find($id);
    }
}
