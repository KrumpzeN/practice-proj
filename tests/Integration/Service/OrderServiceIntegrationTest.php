<?php

namespace Tests\Integration\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\OrderService;
use App\Entity\Order;


class OrderServiceIntegrationTest extends KernelTestCase
{
    private OrderService $orderService;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->orderService = self::$container->get(OrderService::class);
    }

    public function testCreateOrder()
    {
        $orderData = [
            'email' => 'customer@example.com',
            'bike_id' => 1,  // Ensure this ID exists in the bikes table
            'quantity' => 2,
            'total_amount' => 300.00,
        ];
    
        $order = $this->orderService->createOrder($orderData);
    
        $entityManager = self::$container->get('doctrine')->getManager();
        $entity = $entityManager->getRepository(Order::class)->find($order->getId());
    
        $this->assertNotNull($entity);
        $this->assertEquals($orderData['email'], $entity->getEmail());
        $this->assertEquals($orderData['bike_id'], $entity->getBikeId());
        $this->assertEquals($orderData['quantity'], $entity->getQuantity());
        $this->assertEquals($orderData['total_amount'], $entity->getTotalAmount());
    }
    
}
