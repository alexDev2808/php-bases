<?php
// Polimorfismo

class Discount {
    protected $discount = 0;

    public function __construct($discount)
    {
        $this->discount = $discount;
    }

    public function getDiscount($price) {
        echo "Se aplica descuento<br>";
        return $price * $this->discount;
    }
}

class SpecialDiscount extends Discount {
    const SPECIAL_DISCOUNT = 2;

    // Sobreescribir metodos
    public function getDiscount($price)
    {
        echo "Se aplica descuento especial! <br>";
        return $price * $this->discount * self::SPECIAL_DISCOUNT;
    }
}

$discount = new SpecialDiscount(0.1);
$discountAmount = $discount->getDiscount(100);

echo $discountAmount;
echo "<br>#########################################<br>";

// Ahora con interfaces
interface GetInfo {
    public function getInfo(): string;
}

class Address implements GetInfo {
    protected $address;
    public function __construct($address)
    {
        $this->address = $address;
    }

    public function getInfo(): string
    {
        return $this->address;
    }
}

class Website implements GetInfo {
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;  
    }

    public function getInfo(): string
    {
        return file_get_contents($this->url);
    }
}

function printInfo(GetInfo $site) {
    echo $site->getInfo();
}

// $address = new Address('Av. Industrial #29');
// printInfo($address);

$website = new Website('https://hdeleon.net');
printInfo($website);

