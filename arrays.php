<?php

    $names = ["alexis", "jesus", "isabel"];
    echo $names[0]; // alexis
    echo '<br>';

    // Array asociativo
    $person = [
        "name" => "Alexis TH",
        "age" => 30,
        "city" => "Madrid"
    ];

    echo $person["name"];
    echo '<br>';

    // Foreach para recorrer arrays
    foreach ($names as $key => $value) {
        echo "$key: $value <br>";
    }

    foreach ($person as $key => $value) {
        echo "$key: $value <br>";
    }

    echo count($names); // 3
    echo '<br>';
    
    array_push($names, "maria");
    echo count($names); // 4
    echo '<br>';

    $removed_name = array_pop($names);
    echo $removed_name; // maria
    echo '<br>';

    if ( in_array("jesus", $names) ) {
        echo "Jesús está en el array.";
    } else {
        echo "Jesús no está en el array.";
    }
    echo '<br>';


    $cars_arr = ["Toyota", "Honda", "Ford"];
    $cars_arr2 = ["BMW", "Audi", "Mercedes"];

    $all_cars = array_merge($cars_arr, $cars_arr2);
    print_r($all_cars); // Array ( [0] => Toyota [1]