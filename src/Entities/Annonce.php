<?php

class Annonce
{

    private int $id;

    private float $price;
    private string $condition;

    private Product $product;

    private User $user;

    /**
     * @var array of images $images
     */
    private array $images;

    public function __construct(int $price, string $condition, int $id = 0)
    {
        $this->condition = $condition;
        $this->price = $price;
        $this->id = $id;
    }
}
