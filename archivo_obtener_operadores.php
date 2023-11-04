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

// Consulta para obtener la lista de operadores desde la base de datos
$sql = "SELECT id, nombres, apellido_paterno, apellido_materno FROM operadores";
$result = $conn->query($sql);

$operadores = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $operadores[] = array(
            'id' => $row['id'],
            'nombre' => "{$row['nombres']} {$row['apellido_paterno']} {$row['apellido_materno']}"
        );
    }
}

echo json_encode($operadores);

$conn->close();
?>
