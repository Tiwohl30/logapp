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

// Obtener el ID de la unidad seleccionada
$unidadId = $_POST['unidad'];

// Consulta para obtener las llantas asociadas a la unidad
$sql = "SELECT id, fechaAdquisicion, kilometrosRecorridos, idUnidadTractocamion, idUnidadCajaSeca FROM neumaticos WHERE idUnidadTractocamion = $unidadId";
$result = $conn->query($sql);

$llantas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $llantas[] = $row;
    }
}

// Devolver las llantas en formato JSON
echo json_encode($llantas);

$conn->close();
?>
