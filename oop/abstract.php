<?php

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

$beer = new Beer("Lager", 10.00);
echo $beer->getName();
echo "<br>";

showInfo($beer);

function showInfo(Product $product) {
    echo "Product: " . $product->getName() . "<br>";
    echo "Price with tax: " . $product->calculatePrice() . "<br>";
}

// Interfaces

interface SendInterface {
    public function send(string $message): void;
}

interface SaveInterface {
    public function save(): void;
}


class Document implements SendInterface, SaveInterface {
    public function send(string $message): void {
        echo "Sending message: " . $message . "<br>";
    }

    public function save(): void {
        echo "Document saved.<br>";
    }
}

class BeerRepository implements SaveInterface {
    public function save(): void {
        echo "Beer saved in the repository.<br>";
    }
}

class SaveProgress {
    private SaveInterface $saveManager;
    
    public function __construct(SaveInterface $saveManager)
    {
        $this->saveManager = $saveManager;
    }

    public function keep() {
        echo "Hacemos algo antes de guardar...<br>";
        $this->saveManager->save();
    }

}

$beerRepository = new BeerRepository();
$document = new Document();
$saveProgress = new SaveProgress($beerRepository);
$saveProgress->keep();

