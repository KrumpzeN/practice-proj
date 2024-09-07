<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'article' => 'required|string|exists:bikes,article',
            'email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ];
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
