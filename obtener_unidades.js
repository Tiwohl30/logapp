document.addEventListener("DOMContentLoaded", function() {
    // Lógica para cargar las opciones de unidades utilizando fetch
    var selectUnidad = document.getElementById("unidad");

    fetch("obtener_unidades.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(opcion => {
                var option = document.createElement("option");
                option.text = opcion;
                selectUnidad.add(option);
            });
        })
        .catch(error => console.error('Error al obtener las unidades:', error));
});

function obtenerLlantas() {
    // Lógica para obtener y mostrar las llantas utilizando fetch
    var unidadSeleccionada = document.getElementById("unidad").value;
    var url = "obtener_llantas.php";
    
    // Enviar la solicitud al servidor utilizando fetch
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ unidad: unidadSeleccionada })
    })
    .then(response => response.json())
    .then(llantas => {
        // Construir la tabla HTML
        var tablaLlantas = '<table class="table table-bordered mt-3"><thead><tr><th>ID</th><th>Fecha Adquisición</th><th>Kilometraje Recorrido</th></tr></thead><tbody>';

        llantas.forEach(llanta => {
            tablaLlantas += '<tr>';
            tablaLlantas += '<td>' + llanta.id + '</td>';
            tablaLlantas += '<td>' + llanta.fecha_adquisicion + '</td>';
            tablaLlantas += '<td>' + llanta.kilometraje_recorrido + '</td>';
            tablaLlantas += '</tr>';
        });

        tablaLlantas += '</tbody></table>';

        // Mostrar la tabla en el elemento con ID "tablaLlantas"
        document.getElementById("tablaLlantas").innerHTML = tablaLlantas;
    })
    .catch(error => console.error('Error al obtener las llantas:', error));
}
