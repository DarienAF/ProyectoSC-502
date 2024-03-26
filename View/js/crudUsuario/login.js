$(document).ready(function () {
    // Al hacer clic en el botón de inicio de sesión, se ejecuta esta función
    $("#loginBtn").click(async function () {
        event.preventDefault();

        // Recoge los valores de los campos de username y contraseña
        var username = $("#username").val();
        var password = $("#password").val();

        // Limpiar border rojos (si existen)
        $("#username, #password").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#username, #password").each(function () {
            if (!$(this).val()) {
                $(this).css('border', '1px solid red');
                isFormValid = false;
            }
        });
        if (!isFormValid) {
            Swal.fire({
                title: "Todos los campos deben ser completados.",
                icon: "warning",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Realiza una solicitud POST al servidor con los datos del username
        const response = await fetch('./index.php?controller=LoginPage&action=LogIn', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                username: username,
                password: password
            }),
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

        // Recoge los valores de los campos de usuario y contraseña
        var oldPassword = $("#oldPassword").val();
        var newPassword = $("#newPassword").val();

        // Limpiar border rojos (si existen)
        $("#oldPassword, #newPassword").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#oldPassword, #newPassword").each(function () {
            if (!$(this).val()) {
                $(this).css('border', '1px solid red');
                isFormValid = false;
            }
        });
        if (!isFormValid) {
            Swal.fire({
                title: "Todos los campos deben ser completados.",
                icon: "warning",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Realiza una solicitud POST al servidor con los datos del usuario
        const response = await fetch('./index.php?controller=LoginPage&action=changePassword', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                oldPassword: oldPassword,
                newPassword: newPassword
            }),
        });

        // Espera la respuesta del servidor en formato JSON
        const result = await response.json();


        if (result.success) {
            if (result.passwordMatch) {
                $('#passwordChangeModal').modal('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: 'Tu contraseña ha sido actualizada correctamente.',
                    icon: 'success',
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = './index.php?controller=indexPage&action=index'
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Contraseña no coincide con la actual.',
                    icon: 'error',
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                })
            }
        } else {
            if (result.passwordMatch) {
                Swal.fire({
                    title: 'Error',
                    text: 'Error en al actualizar la contraseña.',
                    icon: 'error',
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                })
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error en el servidor.',
                    icon: 'error',
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                })
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