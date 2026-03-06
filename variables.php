<?php 

    # Variables y constantes en PHP
    $nombre = "Alexis";
    const PI = 3.1416;
    $nombre = "Jesus";
    echo 'Hola Mundo! desde Fedora 43'; 
    echo '<br>';
    echo "Hola, $nombre!";
    echo '<br>';
    
    # Tipos de datos en PHP
    $numero = 10;
    $decimal = 3.14;
    $booleano = true;
    $vacio = null;
    $texto = "Hola";

    echo gettype($numero); // integer
    echo '<br>';
    echo gettype($decimal); // double
    echo '<br>';
    echo gettype($booleano); // boolean
    echo '<br>';
    echo gettype($vacio); // NULL
    echo '<br>';
    echo gettype($texto); // string

    # Conversión de tipos
    $numero = (int)"25";
    echo '<br>';
    echo gettype($numero); // integer
    echo '<br>';

    # Condicionales en PHP
    $edad = 20;
    if ($edad >= 18) {
        echo "Eres mayor de edad.";
    } else if($edad < 18 && $edad > 0) {
        echo "Eres menor de edad.";
    } else {
        echo "Edad no válida.";
    }

    switch ($edad) {
        case 18:
            echo "Tienes 18 años.";
            break;
        case 20:
            echo "Tienes 20 años.";
            break;
        default:
            echo "Edad no específica.";
    }

    # Operadores ternarios
    $esta_lloviendo = true;
    $ahorros = 5000.35;
    $ternario = $esta_lloviendo ? "Lleva paraguas." : "No necesitas paraguas.";
    $comprar_cafe = $ahorros > 5 ? "Puedes comprar un café." : "No tienes suficiente dinero para un café.";

    echo '<br>';
    echo $ternario; // Lleva paraguas.
    echo '<br>';
    echo $comprar_cafe; // Puedes comprar un café.
    echo '<br>';

    # Bucles en PHP
    for ($i = 0; $i < 5; $i++) {
        echo "Número: $i <br>";
        if ($i % 2 == 0) {
            echo "$i es par.<br>";
        } else {
            echo "$i es impar.<br>";
        }
    }

    while ($edad < 25) {
        echo "Tienes $edad años. Aún eres joven.<br>";
        $edad++;
    }

    do {
        echo "Actualmente tienes $edad años.<br>";
        $edad++;
    } while ( $edad < 30 );


    # Funciones en PHP
    function saludar(string $nombre, int $edad): string {
        $edad++;
        return "Hola, $nombre! Tienes $edad años.";
    }

    echo saludar("Alexis", "4"); // Hola, Alexis!

    echo '<br>';
    echo strtoupper("hola mundo"); // HOLA MUNDO
    echo '<br>';

    echo mb_strtoupper("Jamón Curado"); // HOLA MUNDO
    echo '<br>';

    echo strlen("Jamón Curado"); // 13
    echo '<br>';

    echo mb_strlen("Jamón Curado"); // 12

    

?>
