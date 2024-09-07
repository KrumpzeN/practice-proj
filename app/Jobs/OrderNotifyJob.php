<?php
namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        Log::info('OrderNotifyJob is being processed.', ['orderId' => $this->order->id]);

        $order = Order::find($this->order->id);
        $order->notified = true;
        $order->save();

        Log::info('Order notified status updated.', ['orderId' => $order->id, 'notified' => $order->notified]);
    }
}
