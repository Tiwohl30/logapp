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
$sql = "SELECT id, nombres, apellido_paterno, apellido_materno, edad, numero_telefonico, fotografia FROM operadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagenBase64 = base64_encode($row['fotografia']); // Convierte la imagen a base64
        $imagenSrc = "data:image/jpeg;base64," . $imagenBase64; // Asume que la imagen es JPEG; ajusta el tipo de imagen según sea necesario

        // Imprime la información y la imagen
        echo "<li>{$row['nombres']} {$row['apellido_paterno']} {$row['apellido_materno']} - Edad: {$row['edad']} - Teléfono: {$row['numero_telefonico']}<br>";
        echo "<img src='$imagenSrc' alt='Fotografía'></li>";
    }
} else {
    echo "No hay registros.";
}

$conn->close();
?>
