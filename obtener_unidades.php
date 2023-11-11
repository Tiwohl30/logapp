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

// Consulta para obtener las opciones de unidades
$sql = "SELECT id, placa, sku FROM unidades WHERE tipo = 'tractocamion'"; // Ajusta la consulta según tu esquema de base de datos

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Construir un array asociativo con las opciones de unidades
    $unidades = array();
    while ($row = $result->fetch_assoc()) {
        $unidades[] = $row;
    }

    // Devolver el array como JSON
    echo json_encode($unidades);
} else {
    echo 'No hay unidades disponibles.';
}

$conn->close();
?>