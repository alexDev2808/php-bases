<?php

declare(strict_types=1);

echo "LLamadas: " . Sale::$called . "<br>"; // Output: 0
$sale = new Sale( date('Y-m-d'));
$onlineSale = new OnlineSale( date('Y-m-d'), "Credit Card");
echo $onlineSale->createInvoice();
echo "<br>";
echo $onlineSale->showInfo();
echo "<br>";
echo $onlineSale->showConcepts();
echo "<br>";

$concept = new Concept("Product A", 50.00);
$concept2 = new Concept("Product B", 134.99);
$sale->addConcept($concept);
echo "Total after adding concept: " . $sale->getTotal() . "<br>"; // Output: 184.99
$sale->addConcept($concept2);
echo "Total after adding concept: " . $sale->getTotal() . "<br>"; // Output: 184.99 + 134.99 = 319.98

echo "LLamadas: " . Sale::$called . "<br>"; // Output: 1

$sale2 = new Sale(date('Y-m-d'));

echo "LLamadas: " . Sale::$called . "<br>"; // Output: 2

// echo $sale->total = 10.5; // Error: Cannot access protected property Sale::$total
echo $sale->date = date('Y-m-d');
print_r($sale);
echo $sale->createInvoice();

class Sale {
    protected float $total;
    public string $date;
    public static $called = 0;
    private $concepts = [];
    protected $sharedConcepts;
    public function __construct(string $date) {
        $this->total = 0;
        $this->date = $date;
        $this->concepts = [];
        $this->sharedConcepts = [];
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
        $this->concepts[] = $concept;
        $this->sharedConcepts[] = $concept; // Agregar a la propiedad protegida para compartir entre instancias
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function createInvoice() {
        return "Invoice created for total: $this->total on date: $this->date";
    }
}

class OnlineSale extends Sale {
    public $paymentMethod;

    // herencia el constructor de la clase padre y agrega el nuevo atributo
    public function __construct(string $date, string $paymentMethod) {
        parent::__construct($date);
        $this->paymentMethod = $paymentMethod;
    }

    // método específico de la clase hija
    public function showInfo(): string {
        return "Online Sale - Total: $this->total, Date: $this->date, Payment Method: $this->paymentMethod";
    }

    public function showConcepts(): string {
        $conceptsInfo = "Concepts for Online Sale:<br>";
        foreach ($this->sharedConcepts as $concept) {
            $conceptsInfo .= "- {$concept->description}: {$concept->amount}<br>";
        }
        return $conceptsInfo;
    }

    public function __destruct()
    {
        echo "<br>Se ha eliminado el objeto OnlineSale<br>";
    }
}

class Concept {
    public string $description;
    public int|float $amount; // Union type for amount

    public function __construct(string $description, int|float $amount) {
        $this->description = $description;
        $this->amount = $amount;
    }
}
