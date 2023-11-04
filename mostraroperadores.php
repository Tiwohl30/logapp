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

// Consulta para obtener registros existentes
$sql = "SELECT * FROM operadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Registros existentes:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['nombres']} {$row['apellido_paterno']} {$row['apellido_materno']} - Edad: {$row['edad']} - Teléfono: {$row['numero_telefonico']}</li>";
    }
    echo "</ul>";
} else {
    echo "No hay registros.";
}

$conn->close();
?>
