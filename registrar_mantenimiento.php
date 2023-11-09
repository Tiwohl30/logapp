<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unidadId = $_POST["unidad"];
    $tipoMantenimiento = $_POST["tipo_mantenimiento"];
    $observaciones = $_POST["observaciones"];

    // Actualizar el campo de mantenimiento en la unidad seleccionada
    $sqlActualizarMantenimiento = "UPDATE unidades SET $tipoMantenimiento = 1 WHERE id = $unidadId";

    if ($conn->query($sqlActualizarMantenimiento) === TRUE) {
        // Mantenimiento registrado con éxito
        echo "Mantenimiento realizado con éxito para la unidad con ID $unidadId";
    } else {
        // Error al registrar el mantenimiento
        echo "Error al registrar el mantenimiento: " . $conn->error;
    }

    // Insertar un registro en la tabla registro_mantenimientos
    $sqlInsertarMantenimiento = "INSERT INTO registro_mantenimientos (unidad_id, tipo_unidad, placa, sku, tipo_mantenimiento, observaciones) 
    SELECT id, tipo, placa, sku, '$tipoMantenimiento', '$observaciones' FROM unidades WHERE id = $unidadId";

    if ($conn->query($sqlInsertarMantenimiento) === TRUE) {
        // Registro de mantenimiento exitoso
    } else {
        // Error al registrar el mantenimiento
    }
}

$conn->close();
?>