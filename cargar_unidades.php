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

// Consulta para obtener unidades existentes
$sql = "SELECT * FROM unidades";
$result = $conn->query($sql);
$unidades = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unidades[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($unidades);
?>
