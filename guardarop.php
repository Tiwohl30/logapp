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

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST["nombres"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $fotografia = $_POST["fotografia"];
    $edad = $_POST["edad"];
    $numero_telefonico = $_POST["numero_telefonico"];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO operadores (nombres, apellido_paterno, apellido_materno, fotografia, edad, numero_telefonico) VALUES ('$nombres', '$apellido_paterno', '$apellido_materno', '$fotografia', $edad, '$numero_telefonico')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener y mostrar los registros existentes
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
