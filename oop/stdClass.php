<?php

// Clases con propiedades dinamicas
$beer = new stdClass();

$beer->name = "Victoria";
$beer->alcohol = 8.5;

$beer->name = "Corona<br>";
echo $beer->name;

// Conversion de objeto a array
$arr = (array) $beer;

echo $arr["name"];
echo "<br>";
echo $arr["alcohol"];

// Conversion de array a objeto
$arrLocation = [
    "address" => "Av. Industrial #9",
    "country" => "Mexico"
];

$objLocation = (object) $arrLocation;

echo "<br>$objLocation->address";
print_r($objLocation);