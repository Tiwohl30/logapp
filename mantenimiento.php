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

// Consulta para obtener la lista de unidades
$sqlUnidades = "SELECT * FROM unidades";
$resultUnidades = $conn->query($sqlUnidades);

// Consulta para obtener los registros de mantenimientos (debes crear esta tabla)
$sql = "SELECT * FROM registro_mantenimientos";


if ($resultUnidades->num_rows > 0) {
    $unidades = array();
    while ($rowUnidad = $resultUnidades->fetch_assoc()) {
        $unidades[] = $rowUnidad;
    }
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mantenimientos = array();
    while ($row = $result->fetch_assoc()) {
        $mantenimientos[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7Rxnatzjc#DSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Registro de Mantenimientos</title>
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
            <a class="nav-link active" aria-current="page" href="index.html">Registro operadores</a>
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
                    <a class="nav-link active" href="neumaticos.php">Registro Neumáticos</a>
        </li>
        <li class="nav-item">
                <a class="nav-link active" href="listallantas.html">Listado de neumaticos</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- ... (otros elementos HTML) ... -->
    <div class="container">
        <h1 class="mt-5">Calcular Estado de Mantenimiento</h1>
        <div class="table-responsive">
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Placa</th>
                        <th>SKU</th>
                        <th>Kilometraje Recorrido</th>
                        <th>Primer Mantenimiento Tipo 1</th>
                        <th>Segundo Mantenimiento Tipo 1</th>
                        <th>Primer Mantenimiento Tipo 2</th>
                        <th>Restablecer Mantenimientos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unidades as $unidad) { ?>
                        <tr>
                            <td><?= $unidad['id'] ?></td>
                            <td><?= $unidad['tipo'] ?></td>
                            <td><?= $unidad['placa'] ?></td>
                            <td><?= $unidad['sku'] ?></td>
                            <td><?= $unidad['kilometraje_recorrido'] ?></td>
                            <td><?= $unidad['primer_mantenimiento_tipo_1'] ? 'Realizado' : 'Pendiente' ?></td>
                            <td><?= $unidad['segundo_mantenimiento_tipo_1'] ? 'Realizado' : 'Pendiente' ?></td>
                            <td><?= $unidad['primer_mantenimiento_tipo_2'] ? 'Realizado' : 'Pendiente' ?></td>
                            <td>
                             <form method="POST" action="restablecer_mantenimientos.php">
                            <input type="hidden" name="unidadId" value="<?= $unidad['id'] ?>">
                            <button type="submit" class="btn btn-warning" name="restablecerMantenimientos">Restablecer</button>
                            </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <h2 class="mt-5">Realizar Mantenimiento</h2>
        <form method="POST" action="registrar_mantenimiento.php">
            <div class="form-group"> 
                <label for="unidad">Seleccionar Unidad</label>
                <select class="form-control" name="unidad" id="unidad" required>
                    <?php foreach ($unidades as $unidad) { ?>
                        <option value="<?= $unidad['id'] ?>"><?= $unidad['tipo'] ?> - <?= $unidad['placa'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo_mantenimiento">Tipo de Mantenimiento</label>
                <select class="form-control" name="tipo_mantenimiento" id="tipo_mantenimiento" required>
                    <option value="primer_mantenimiento_tipo_1">Primer Mantenimiento Tipo 1</option>
                    <option value="segundo_mantenimiento_tipo_1">Segundo Mantenimiento Tipo 1</option>
                    <option value="primer_mantenimiento_tipo_2">Primer Mantenimiento Tipo 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" name="observaciones" id="observaciones" required>
            </div><br><br>
            <button type="submit" class="btn btn-primary">Realizar Mantenimiento</button><br><br>
        </form>
        <div class="table-responsive">
            <h2 class="mt-4">Bitacora registros: </h2>
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unidad ID</th>
                        <th>Tipo de Unidad</th>
                        <th>Placa</th>
                        <th>SKU</th>
                        <th>Observaciones</th>
                        <th>Tipo de Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mantenimientos as $mantenimiento) { ?>
                        <tr>
                            <td><?= $mantenimiento['id'] ?></td>
                            <td><?= $mantenimiento['unidad_id'] ?></td>
                            <td><?= $mantenimiento['tipo_unidad'] ?></td>
                            <td><?= $mantenimiento['placa'] ?></td>
                            <td><?= $mantenimiento['sku'] ?></td>
                            <td><?= $mantenimiento['observaciones'] ?></td>
                            <td><?= $mantenimiento['tipo_mantenimiento'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
