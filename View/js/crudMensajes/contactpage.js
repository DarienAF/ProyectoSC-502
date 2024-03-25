$(document).ready(function () {
    // Al hacer clic en el botón de contacto, se ejecuta esta función.
    $("#contactBtn").click(async function (event) {
        event.preventDefault();

        var firstNameMsg = $("#firstNameMsg").val();
        var lastNameMsg = $("#lastNameMsg").val();
        var emailMsg = $("#emailMsg").val();
        var titleMsg = $("#titleMsg").val();
        var contextMsg = $("#contextMsg").val();


        // Limpiar border rojos (si existen)
        $("#firstNameMsg, #lastNameMsg, #emailMsg, #titleMsg, #contextMsg").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#firstNameMsg, #lastNameMsg, #emailMsg, #titleMsg, #contextMsg").each(function () {
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
        if (!regexCorreo.test(emailMsg)) {
            $("#emailMsg").css('border', '1px solid red');
            Swal.fire({
                title: "¡Hubo un error!",
                text: "Ingrese un emailMsg electrónico válido.",
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
                fullNameMsg: firstNameMsg + " " + lastNameMsg,
                emailMsg: emailMsg,
                titleMsg: titleMsg,
                contextMsg: contextMsg
            }),
        });

        const result = await response.json();

        // Si la respuesta es exitosa, muestra un mensaje de éxito y limpia los campos.
        if (result.success) {
            Swal.fire({
                title: "¡Pronto te contactaremos!",
                text: "Tu mensaje ha sido enviado correctamente.",
                icon: "success",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            $("#firstNameMsg, #lastNameMsg, #emailMsg, #titleMsg, #contextMsg").val('');
        } else {
            // Si hay un error, muestra un mensaje de error.
            Swal.fire({
                title: "¡Hubo un error!",
                text: result.message,
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});
