<?php

declare(strict_types=1);

echo "LLamadas: " . Sale::$called . "<br>"; // Output: 0
$sale = new Sale(134.99, date('Y-m-d'));
$concept = new Concept("Product A", 50.00);
$sale->addConcept($concept);
echo "Total after adding concept: " . $sale->total . "<br>"; // Output: 184.99
echo "LLamadas: " . Sale::$called . "<br>"; // Output: 1

$sale2 = new Sale(200.00, date('Y-m-d'));

echo "LLamadas: " . Sale::$called . "<br>"; // Output: 2

echo $sale->total = 10.5;
echo $sale->date = date('Y-m-d');
print_r($sale);
echo $sale->createInvoice();

class Sale {
    public float $total;
    public string $date;
    public static $called = 0;
    public function __construct(float $total, string $date) {
        $this->total = $total;
        $this->date = $date;
        self::$called += 1;
    }

    public function reset() {
        self::$called = 0;
    }

    public function __destruct()
    {
        echo "<br>Se ha eliminado el objeto<br>";
    }
    
    public function addConcept(Concept $concept) {
        $this->total += $concept->amount;
    }

    public function createInvoice() {
        return "Invoice created for total: $this->total on date: $this->date";
    }
}

class Concept {
    public string $description;
    public float $amount;

    public function __construct(string $description, float $amount) {
        $this->description = $description;
        $this->amount = $amount;
    }
}