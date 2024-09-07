<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use App\DTOs\CreateOrderFormModel;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(CreateOrderRequest $request)
{
    $orderData = new CreateOrderFormModel(
        $request->article,
        $request->email,
        $request->quantity
    );

    try {
        $order = $this->orderService->createOrder($orderData);
        return redirect()->route('bikes.index')->with('success', 'Order created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
}
