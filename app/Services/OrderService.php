<?php
namespace App\Services;

use App\Jobs\OrderNotifyJob;
use App\Models\Order;
use App\Models\Bike;
use App\DTOs\CreateOrderFormModel;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function createOrder(CreateOrderFormModel $dto)
    {
        $bike = Bike::where('article', $dto->article)->first();

        if (!$bike || !$bike->availability) {
            throw new \Exception('Bike not available.');
        }

        $totalAmount = $this->calculateAmount($dto->quantity, $bike->price);

        $order = Order::create([
            'email' => $dto->email,
            'bike_id' => $bike->id,
            'quantity' => $dto->quantity,
            'total_amount' => $totalAmount,
        ]);

        Log::info('Order created and job dispatched.', ['orderId' => $order->id]);

        OrderNotifyJob::dispatch($order);

        return $order;
    }

    public function calculateAmount($quantity, $price)
    {
        return $quantity * $price;
    }
}
