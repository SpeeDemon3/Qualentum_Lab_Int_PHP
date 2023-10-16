<?php

// Obtengo la informacion introducida por el usuario
// y la guardo en variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nombre'];
    $age = $_POST['edad'];
    $description = $_POST['descripcion'];

    //echo "<p>Nombre -> $name | Edad -> $age | Descripcion -> $description</p>";

    // Guardo los datos (nombre y descriocion del usuario) en un archivo a la misma altura
    // se creara si no existe
    $fileName = "nombre.txt"; // Variable con el nombre del archivo
    $nameAndDescriptionUser = "Nombre -> $name | Descrioción -> $description";
    // Paso nombre del archivo e indico que quiero anexar en el para que no se me sobrescriba la informacion cada vez que se introducen nuevos datos, 
    // tambien controlo el error que pudiese ocurrir al no poder abrir el archivo
    $fileUser = fopen($fileName, "a") or die ("Error al abrir el fichero"); 
    // Escribo en el archivo y lo cierro al finalizar
    fwrite($fileUser, $nameAndDescriptionUser . PHP_EOL); // Agrego una nueva linea utilizando PHP_EOL
    fclose($fileUser); 

    // Guardo los datos (edad) en un archivo a la misma altura
    // se creara si no existe
    $fileAge = "edad.txt"; // Nombre del archivo
    $ageUser = "Edad -> $age"; // Informacion a guardar
    // Paso nombre del archivo e indico que quiero anexar en el para que no se me sobrescriba la informacion cada vez que se introducen nuevos datos, 
    // tambien controlo el error que pudiese ocurrir al no poder abrir el archivo
    $fileUserAge = fopen($fileAge, "a") or die ("Error al abrir el fichero"); 
    // Escribo en el archivo y lo cierro al finalizar
    fwrite($fileUserAge, $ageUser . PHP_EOL); // Agrego una nueva linea utilizando PHP_EOL
    fclose($fileUserAge);

    // Invoco la funcion para leer el archivo
    readFileAge($fileAge);

}

function readFileAge($nameFile) {

    // Abro el archivo recibido por parametro en modo lectura
    $fileUsersAge = fopen($nameFile, "r");

    // Creo un array para guardar las edades
    $ages = array();

    // Recorro el archivo hasta llegar al final
    while(!feof($fileUsersAge)) {
        $line = fgets($fileUsersAge); // Leo una linea del archivo
        $parts = explode("->", $line); // Separo la linea en partes utilizando el delimitador "->"

        if (count($parts) === 2) {
            $age = trim($parts[1]); // Obtengo la parte que contiene la edad eliminando espacios a los lados
            $ages[] = $age; // Añado la edad al array
        }

    }

    // Cierro el archivo
    fclose($fileUsersAge);

    // Invoco la funcion para calcular y mostrar la media de edad    
    printCalculateAverage($ages);

}

/**
 * Funcion para calcular la media de los valores obtenidos por un array
 * y mostrarlo por pantalla
 */
function printCalculateAverage($array) {
    
    // Creo una variable para obtener la longitud del array
    $lengthArray = count($array);
    // Creo una variable contador para sumar todas las edades
    $countAge = 0;

    // Recorro el array
    foreach ($array as $value) {
        $countAge += $value; // Acumulo la suma de las edades
    }


    // Obtengo la media, la redondeo y la guardo en una variable
    $avgAge = round($countAge / $lengthArray);

    // Imprimo por pantalla
    echo "<h2>La media de edad de los usuario es de $avgAge años.</h2>";


}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP Antonio Ruiz Benito</title>
</head>
<body>
    
    <h1>Contacto</h1>

    <form action="indexARB.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <br></br>

        <label for="edad">Edad</label>
        <input type="number" name="edad" id="edad" required>
        <br></br>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Introducir descripción" required></textarea>
        <br></br>

        <input type="submit" value="Enviar">

    </form>

    
</body>
</html>