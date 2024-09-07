<div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Order Statistics</h3>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left text-gray-600 dark:text-gray-300">Email</th>
                <th class="text-left text-gray-600 dark:text-gray-300">Bike Name</th>
                <th class="text-left text-gray-600 dark:text-gray-300">Price</th>
                <th class="text-left text-gray-600 dark:text-gray-300">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->getOrders() as $order)
                <tr>
                    <td class="text-gray-800 dark:text-gray-200 px-2">{{ $order->email }}</td>
                    <td class="text-gray-800 dark:text-gray-200 px-2">{{ $order->bike->name }}</td>
                    <td class="text-gray-800 dark:text-gray-200 px-2">{{ $order->bike->price }}</td>
                    <td class="text-gray-800 dark:text-gray-200 px-2">{{ $order->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
