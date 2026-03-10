<?php

trait EmailSender {
    public function sendEmail() {
        echo "Email sent!<br>";
    }
}

trait DB {
    public function save() {
        echo "Data saved to database!<br>";
    }
}

trait Log {
    protected function log(string $message, string $filename) {
        if (!file_exists($filename)) {
            file_put_contents($filename, "");
        }
        $current = file_get_contents($filename);
        $current .= date("Y-m-d H:i:s") . " - " . $message . "\n";
        file_put_contents($filename, $current);
    }
}
class Invoice {
    use EmailSender, DB, Log;

    public function create() {
        echo "Invoice created succesfully!<br>";
        echo __DIR__ . "/invoice.txt<br>";
        $this->log("Invoice created succesfully!", __DIR__ . "/invoice.txt");
    }
}

$invoice = new Invoice();
$invoice->sendEmail(); // Output: Email sent!
$invoice->save();
$invoice->create(); // Output: Invoice created!