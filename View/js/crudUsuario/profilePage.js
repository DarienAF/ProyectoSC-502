async function updateUserData() {
    // Recolecta los valores de los campos del formulario
    const userId = $('#userId').val();
    const username = $('#username').val();
    const role = $('#role').val();
    const firstName = $('#firstName').val();
    const lastName = $('#lastName').val();
    const email = $('#email').val();
    const phone = $('#phone').val();

    const formData = new FormData();
    const imageInput = document.getElementById('profileImage');

    if (imageInput.files.length > 0) {
        const file = imageInput.files[0];
        formData.append('profileImage', file);
    }

    formData.append('userId', userId);
    formData.append('username', username);
    formData.append('role', role);
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('email', email);
    formData.append('phone', phone);

    // Validación  para el correo electrónico
    if (!validateEmail(email)) {
        showValidationError("¡Correo electrónico inválido!");
        return;
    }

    // Validación  para el nombre de usuario
    if (!validateUsername(username)) {
        showValidationError("¡Nombre de usuario inválido! El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.");
        return;
    }

    // Intenta enviar la solicitud de actualización al servidor
    try {
        const response = await fetch('./index.php?controller=ProfilePage&action=updateUser', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Actualiza la interfaz de usuario con los nuevos datos
            let message = result.changed ? 'Los cambios fueron guardados con éxito.' : 'No se ingresaron cambios al usuario.';
            Swal.fire({
                title: '¡Éxito!',
                text: message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    window.location.href = './index.php?controller=ProfilePage&action=index'
                }
            });
        } else {
            if (result.error == 'usuario') {
                $("#username").css('border', '1px solid red');
            } else if (result.error == 'correo') {
                $("#email").css('border', '1px solid red');
            }

            let errorMessage = result.message || 'Hubo un problema al guardar los cambios.';
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al actualizar el usuario', error);
        Swal.fire({
            title: 'Error al actualizar el usuario',
            text: 'Hubo un problema al conectar con el servidor.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
}


// Función para validar el formato del correo electrónico
function validateEmail(email) {
    let regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regexCorreo.test(email);
}

// Función para validar el nombre de usuario
function validateUsername(username) {
    let regexUsuario = /^[a-zA-Z0-9_-]+$/;
    return regexUsuario.test(username);
}


// Función para mostrar un mensaje de error de validación
function showValidationError(message) {
    Swal.fire({
        title: message,
        icon: "error",
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    });
}

$(document).ready(function () {
    $('#changePwBtn').click(function () {
        $('#passwordChangeModal').modal('show');
    });
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
        const response = await fetch('./index.php?controller=ProfilePage&action=changePassword', {
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
    $('.form-control').prop('readonly', true);
    $('#profileImage-container').hide();

    $('#editBtn').click(function () {
        $('.form-control').each(function () {
            if (this.id !== 'userId' && this.id !== 'username' && this.id !== 'role') {
                $(this).prop('readonly', false);
            }
        });

        $('#profileImage-container').show();

        $('#saveBtn').show();
        $('#cancelBtn').show();
        $('#editBtn').hide();
    });

    $('#closeModalBtn').click(function () {
        $('#passwordChangeModal').modal('hide');
    });


    $('#cancelBtn').click(function () {
        location.reload();
    });
});
