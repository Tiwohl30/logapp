<?php
// editar_llanta.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $llantaId = $_POST['llantaId'];
    $nuevaFecha = $_POST['nuevaFecha'];

    $sql = "UPDATE neumaticos SET fechaAdquisicion = '$nuevaFecha', kilometrosRecorridos = 0 WHERE id = $llantaId";

    if ($conn->query($sql) === TRUE) {
        echo "Modificación exitosa";
    } else {
        echo "Error en la modificación: " . $conn->error;
    }
}

$conn->close();
?>
