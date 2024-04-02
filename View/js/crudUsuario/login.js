$(document).ready(function () {
    // Al hacer clic en el botón de inicio de sesión, se ejecuta esta función
    $("#loginBtn").click(async function () {
        event.preventDefault();

        // Validación de campos
        const fields = ["username", "password"];
        if (!validateForm(fields)) {
            showWarning("Todos los campos deben ser completados.");
            return;
        }

        // Recolecta los datos del formulario y valida cada campo
        const formData = {
            username: $("#username").val().trim(),
            password: $("#password").val().trim()
        };

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=LoginPage&action=LogIn', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        // Espera la respuesta del servidor en formato JSON
        const result = await response.json();


        if (result.success) {
            if (result.changePassword) {
                $('#passwordChangeModal').modal('show');
            } else {
                location.href = './index.php?controller=indexPage&action=index'
            }
        } else {
            if (result.error == 'usuario' || result.error == 'ambos') {
                $("#username").css('border', '1px solid red');
            }
            if (result.error == 'contraseña' || result.error == 'ambos') {
                $("#password").css('border', '1px solid red');
            }
            Swal.fire({
                title: "¡Hubo un error!",
                text: result.message,
                icon: result.icon,
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    })
});


$(document).ready(function () {
    $("#savePasswordBtn").click(async function () {
        event.preventDefault();

        // Validación de campos
        const fields = ["oldPassword", "newPassword"];
        if (!validateForm(fields)) {
            showWarning("Todos los campos deben ser completados.");
            return;
        }

        // Recolecta los datos del formulario y valida cada campo
        const formData = {
            oldPassword: $("#oldPassword").val().trim(),
            newPassword: $("#newPassword").val().trim()
        };

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=LoginPage&action=changePassword', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        // Espera la respuesta del servidor en formato JSON
        const result = await response.json();


        if (result.success) {
            if (result.passwordMatch) {
                $('#passwordChangeModal').modal('hide');
                showSuccessAndRedirect('Tu contraseña ha sido actualizada correctamente.',
                    './index.php?controller=indexPage&action=index')
            } else {
                showError('Contraseña no coincide con la actual.')
            }
        } else {
            if (result.passwordMatch) {
                showError('Error en al actualizar la contraseña.')
            } else {
                showError('Error en el servidor.')
            }
        }
    })
});


$(document).ready(function () {
    $("#togglePassword").click(function () {
        // Verifica el tipo actual del campo de contraseña
        var tipo = $("#password").attr("type");
        var icon = $(this).find('i'); 

        // Cambia el tipo del campo y alterna entre los íconos
        if (tipo === "password") {
            $("#password").attr("type", "text");
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            $("#password").attr("type", "password");
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });
});