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

// Consulta para obtener las unidades de tipo tractocamión
$sqlTractocamiones = "SELECT * FROM unidades WHERE tipo = 'tractocamion'";
$resultTractocamiones = $conn->query($sqlTractocamiones);

// Consulta para obtener las unidades de tipo caja seca
$sqlCajasSecas = "SELECT * FROM unidades WHERE tipo = 'caja_seca'";
$resultCajasSecas = $conn->query($sqlCajasSecas);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUnidadTractocamion = $_POST["unidadTractocamion"];
    $idUnidadCajaSeca = $_POST["unidadCajaSeca"];
    $fechaAdquisicion = $_POST["fechaAdquisicion"];
    $kilometrosRecorridos = $_POST["kilometrosRecorridos"];

    // Insertar automáticamente 18 registros
    for ($i = 1; $i <= 18; $i++) {
        $sqlInsertarNeumatico = "INSERT INTO neumaticos (idUnidadTractocamion, idUnidadCajaSeca, fechaAdquisicion, kilometrosRecorridos) 
                                VALUES ($idUnidadTractocamion, $idUnidadCajaSeca, '$fechaAdquisicion', $kilometrosRecorridos)";

        if ($conn->query($sqlInsertarNeumatico) !== TRUE) {
            echo "Error al registrar el neumático: " . $conn->error;
            break;  // Detener el bucle si hay un error
        }
    }

    
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Registro de Neumáticos</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html">Registro operadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="unidades.html">Registro unidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="registro_rutas.html">Registro rutas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="mantenimiento.php">Mantenimientos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="registro_neumaticos.php">Registro Neumáticos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="mt-5">Registro de Neumáticos</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="unidadTractocamion" class="form-label">Seleccionar Unidad Tractocamión</label>
            <select class="form-select" name="unidadTractocamion" id="unidadTractocamion" required>
                <?php while ($row = $resultTractocamiones->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['tipo'] . ' - ' . $row['id']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="unidadCajaSeca" class="form-label">Seleccionar Unidad Caja Seca</label>
            <select class="form-select" name="unidadCajaSeca" id="unidadCajaSeca" required>
                <?php while ($row = $resultCajasSecas->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['tipo'] . ' - ' . $row['id']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fechaAdquisicion" class="form-label">Fecha de Adquisición</label>
            <input type="date" class="form-control" name="fechaAdquisicion" id="fechaAdquisicion" required>
        </div>
        <div class="mb-3">
            <label for="kilometrosRecorridos" class="form-label">Kilómetros Recorridos</label>
            <input type="number" class="form-control" name="kilometrosRecorridos" id="kilometrosRecorridos" required>
        </div>
        <button type="submit" class="btn btn-primary" onclick="recargarPagina()">Registrar Neumático</button>
    </form>
    <script>
         function recargarPagina() {
        location.reload();
    }
    </script>
</div>

</body>
</html>
