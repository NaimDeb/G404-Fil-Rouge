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


    // Construct 
    public function __construct(int $price, string $condition, int $id = 0)
    {
        $this->condition = $condition;
        $this->price = $price;
        $this->id = $id;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    // Setters

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setImages(array $images)
    {

        foreach ($images as $image) {
            if (!$image instanceof Image) {
                throw new InvalidArgumentException('The images array must contain only Image objects');
            }
        }

        $this->images = $images;
    }



}
