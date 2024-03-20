$(document).ready(function () {
    // Al hacer clic en el botón de contacto, se ejecuta esta función.
    $("#contactBtn").click(async function (event) {
        event.preventDefault();

        var nombreM = $("#nombreM").val();
        var apellidoM = $("#apellidoM").val();
        var correo = $("#correo").val();
        var titulo = $("#titulo").val();
        var contexto = $("#contexto").val();


        // Limpiar border rojos (si existen)
        $("#nombreM, #apellidoM, #correo, #titulo, #contexto").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#nombreM, #apellidoM, #correo, #titulo, #contexto").each(function () {
            if (!$(this).val()) {
                $(this).css('border', '1px solid red');
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            Swal.fire({
                title: "Todos los campos deben ser completados.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Validación del correo electrónico
        var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regexCorreo.test(correo)) {
            $("#correo").css('border', '1px solid red');
            Swal.fire({
                title: "¡Hubo un error!",
                text: "Ingrese un correo electrónico válido.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=ContactPage&action=Contact', {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                nombre: nombreM + " " + apellidoM,
                correo: correo,
                titulo: titulo,
                contexto: contexto
            }),
        });

        const data = await response.json();

        // Si la respuesta es exitosa, muestra un mensaje de éxito y limpia los campos.
        if (data.success) {
            Swal.fire({
                title: "¡Pronto te contactaremos!",
                text: "Tu mensaje ha sido enviado correctamente.",
                icon: "success",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            $("#nombreM, #apellidoM, #correo, #titulo, #contexto").val('');
        } else {
            // Si hay un error, muestra un mensaje de error.
            Swal.fire({
                title: "¡Hubo un error!",
                text: data.message,
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});
