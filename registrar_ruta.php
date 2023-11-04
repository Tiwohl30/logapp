<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $operador_id = $_POST["operador"];
    $unidad_id = $_POST["unidad"];
    $lugar_inicio = $_POST["lugar_inicio"];
    $lugar_final = $_POST["lugar_final"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_final = $_POST["fecha_final"];
    $kilometraje_inicial = $_POST["kilometraje_inicial"];
    $kilometraje_final = $_POST["kilometraje_final"];
    $kilometraje_recorrido = $kilometraje_final - $kilometraje_inicial;

    // Insertar los datos en la tabla de rutas
    $sql = "INSERT INTO rutas (operador_id, unidad_id, lugar_inicio, lugar_final, fecha_inicio, fecha_final, kilometraje_inicial, kilometraje_final, kilometraje_recorrido)
            VALUES ($operador_id, $unidad_id, '$lugar_inicio', '$lugar_final', '$fecha_inicio', '$fecha_final', $kilometraje_inicial, $kilometraje_final, $kilometraje_recorrido)";

    if ($conn->query($sql) === TRUE) {
        echo "Registro de ruta exitoso";
    } else {
        echo "Error al registrar la ruta: " . $conn->error;
    }

    $conn->close();
}
?>
