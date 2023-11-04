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

// Consulta para obtener la lista de unidades desde la base de datos
$sql = "SELECT id, tipo, placa, sku FROM unidades";
$result = $conn->query($sql);

$unidades = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unidades[] = array(
            'id' => $row['id'],
            'descripcion' => "{$row['tipo']} - Placa: {$row['placa']} - SKU: {$row['sku']}"
        );
    }
}

echo json_encode($unidades);

$conn->close();
?>
