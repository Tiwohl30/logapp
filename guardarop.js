// Función para guardar los datos en localStorage
function guardarRegistro() {
    const form = document.getElementById("registroForm");
    const nombres = form.nombres.value;
    const apellidoPaterno = form.apellido_paterno.value;
    const apellidoMaterno = form.apellido_materno.value;
    const fotografia = form.fotografia.value;
    const edad = form.edad.value;
    const numeroTelefonico = form.numero_telefonico.value;

    // Crear un objeto con los datos
    const registro = {
        nombres,
        apellidoPaterno,
        apellidoMaterno,
        fotografia,
        edad,
        numeroTelefonico
    };

    // Obtener registros existentes de localStorage o crear un nuevo arreglo
    const registros = JSON.parse(localStorage.getItem("registros")) || [];

    // Agregar el nuevo registro
    registros.push(registro);

    // Guardar en localStorage
    localStorage.setItem("registros", JSON.stringify(registros));

    // Limpiar el formulario
    form.reset();

    // Mostrar los registros en pantalla
    mostrarRegistros();
}

// Función para mostrar los registros en pantalla
function mostrarRegistros() {
    const registrosList = document.getElementById("registrosList");
    registrosList.innerHTML = "";

    const registros = JSON.parse(localStorage.getItem("registros")) || [];

    registros.forEach(registro => {
        const listItem = document.createElement("li");
        listItem.textContent = `${registro.nombres} ${registro.apellidoPaterno} ${registro.apellidoMaterno} - Edad: ${registro.edad} - Teléfono: ${registro.numeroTelefonico}`;
        registrosList.appendChild(listItem);
    });
}

// Mostrar los registros existentes al cargar la página
mostrarRegistros();

// Escuchar el envío del formulario
const registroForm = document.getElementById("registroForm");
registroForm.addEventListener("submit", function (event) {
    event.preventDefault();
    guardarRegistro();
});