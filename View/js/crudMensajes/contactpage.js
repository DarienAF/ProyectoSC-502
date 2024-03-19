$(document).ready(function () {
    // Al hacer clic en el botón de contacto, se ejecuta esta función.
    $("#contactBtn").click(async function (event) {
        event.preventDefault();

        var nombreM = $("#nombreM").val();
        var apellidoM = $("#apellidoM").val();
        var nombreCompleto = nombreM + " " + apellidoM; // Concatenar nombre y apellido
        var correo = $("#correo").val();
        var titulo = $("#titulo").val();
        var contexto = $("#contexto").val();

        // Verifica si todos los campos están llenos.
        if (nombreCompleto && correo && titulo && contexto) {
            // Realiza una solicitud POST al servidor con los datos del formulario.
            const response = await fetch('./index.php?controller=ContactPage&action=Contact', {
                method: "POST",
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    nombre    : nombreCompleto,
                    correo    : correo,
                    titulo    : titulo,
                    contexto  : contexto
                }),
            });

            const data = await response.json();

            // Si la respuesta es exitosa, muestra un mensaje de éxito.
            if (data.success) {
                alert("¡Mensaje enviado correctamente!");
            } else {
                // Si hay un error, muestra un mensaje de error.
                alert(data.message);
            }
        } else {
            // Si algún campo está vacío, muestra un mensaje de error.
            alert("Por favor, rellene todos los campos.");
        }
    });
});
