<?php
namespace App\DTOs;

class CreateOrderFormModel
{
    public string $article;
    public string $email;
    public int $quantity;

    public function __construct(string $article, string $email, int $quantity)
    {
        $this->article = $article;
        $this->email = $email;
        $this->quantity = $quantity;
    }
}
