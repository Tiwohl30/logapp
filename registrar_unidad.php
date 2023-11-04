<?php
// Conexión a la base de datos (reemplaza con tus propios valores)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

// Recoger los datos del formulario
$tipo = $_POST["tipo"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$anio = $_POST["anio"];
$placa = $_POST["placa"];
$sku = $_POST["sku"];
$kilometraje = $_POST["kilometraje"];

// Insertar los datos en la base de datos
$sql = "INSERT INTO unidades (tipo, marca, modelo, anio, placa, sku, kilometraje) 
        VALUES ('$tipo', '$marca', '$modelo', $anio, '$placa', '$sku', $kilometraje)";

// Resto del código para ejecutar la consulta SQL

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
