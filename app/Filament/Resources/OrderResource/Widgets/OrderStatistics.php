<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\Widget;

class OrderStatistics extends Widget
{
    protected static string $view = 'filament.widgets.order-stats';

    public function getOrders(): \Illuminate\Support\Collection
    {
        return Order::all();
    }
}
