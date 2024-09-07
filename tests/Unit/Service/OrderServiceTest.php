<?php

namespace Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use App\Services\OrderService;

class OrderServiceTest extends TestCase
{
    private OrderService $orderService;

    protected function setUp(): void
    {
        $this->orderService = new OrderService();
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('amountProvider')]
    public function testCalculateAmount($quantity, $price, $expected)
    {
        $this->assertEquals($expected, $this->orderService->calculateAmount($quantity, $price));
    }

    public static function amountProvider(): iterable
    {
        return [
            [2, 100, 200],    // 2 * 100 = 200
            [1, 150, 150],    // 1 * 150 = 150
            [0, 200, 0],      // 0 * 200 = 0
            [5, 0, 0],        // 5 * 0 = 0
            [-1, 100, -100],  // -1 * 100 = -100 (optional case)
        ];
    }
}
