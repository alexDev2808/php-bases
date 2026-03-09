<?php

$beer = new Beer("Lager", 10.00);
echo $beer->getName();
echo "<br>";

showInfo($beer);

function showInfo(Product $product) {
    echo "Product: " . $product->getName() . "<br>";
    echo "Price with tax: " . $product->calculatePrice() . "<br>";
}


abstract class Product {
    protected float $price;
    protected string $name;

    abstract public function calculatePrice(): float;

    public function getName(): string {
        return $this->name;
    }
}

class Beer extends Product {
    const TAX = 1.16;
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function calculatePrice(): float {
        return $this->price * self::TAX;
    }

}