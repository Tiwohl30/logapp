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

// Consulta para obtener las rutas desde la base de datos con los datos de operador y unidad
$sql = "SELECT rutas.id, operadores.id AS operadorid, unidades.id AS unidadid, operadores.nombres AS operador_nombre, operadores.apellido_paterno AS apellido_paterno, operadores.apellido_materno AS apellido_materno, unidades.tipo AS unidad_tipo, unidades.placa AS unidad_placa, rutas.lugar_inicio, rutas.lugar_final, rutas.fecha_inicio, rutas.fecha_final, rutas.kilometraje_inicial, rutas.kilometraje_final, rutas.kilometraje_recorrido, rutas.observaciones FROM rutas
        INNER JOIN operadores ON rutas.operador_id = operadores.id
        INNER JOIN unidades ON rutas.unidad_id = unidades.id";

$result = $conn->query($sql);

$rutas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rutas[] = $row;
    }
}

echo json_encode($rutas);

$conn->close();
?>
