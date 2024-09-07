<?php

namespace Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Order;

class OrderControllerTest extends WebTestCase
{
    public function testCreateOrder()
    {
        $client = static::createClient();
        $orderData = [
            'email' => 'customer@example.com', // Replace with a valid email
            'bike_id' => 1,                    // Ensure this ID exists in the bikes table
            'quantity' => 2,                   // Example quantity
            'total_amount' => 300.00,          // Example total amount
        ];

        $this->assertResponseIsSuccessful();

        $entityManager = self::$container->get('doctrine')->getManager();
        $order = $entityManager->getRepository(Order::class)->findOneBy(['email' => 'customer@example.com']);

        $this->assertNotNull($order);
        $this->assertEquals($orderData['email'], $order->getEmail());
        $this->assertEquals($orderData['bike_id'], $order->getBikeId());
        $this->assertEquals($orderData['quantity'], $order->getQuantity());
        $this->assertEquals($orderData['total_amount'], $order->getTotalAmount());
    }
}
