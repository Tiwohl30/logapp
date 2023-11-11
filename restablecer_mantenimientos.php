<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["restablecerMantenimientos"])) {
  $unidadId = $_POST["unidadId"];

  // Conexión a la base de datos (reemplaza con tus propios valores)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "log";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
  }

  // Actualizar los estados de mantenimiento a "False"
  $sqlActualizarMantenimientos = "UPDATE unidades SET primer_mantenimiento_tipo_1 = 0, segundo_mantenimiento_tipo_1 = 0, primer_mantenimiento_tipo_2 = 0 WHERE id = $unidadId";

  if ($conn->query($sqlActualizarMantenimientos) === TRUE) {
    // Éxito al restablecer los mantenimientos
    echo "Estados de mantenimiento restablecidos con éxito para la unidad con ID $unidadId";
  } else {
    // Error al restablecer los mantenimientos
    echo "Error al restablecer los estados de mantenimiento: " . $conn->error;
  }

  $conn->close();
}
?>
