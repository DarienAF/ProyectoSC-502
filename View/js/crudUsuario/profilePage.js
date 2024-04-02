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
        showError("¡Correo electrónico inválido!");
        return;
    }

    // Validación  para el nombre de usuario
    if (!validateUsername(username)) {
        showError("¡Nombre de usuario inválido! El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.");
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
            showSuccessAndRedirect(message, './index.php?controller=ProfilePage&action=index');
        } else {
            if (result.error == 'usuario') {
                $("#username").css('border', '1px solid red');
            } else if (result.error == 'correo') {
                $("#email").css('border', '1px solid red');
            }
            let errorMessage = result.message || 'Hubo un problema al guardar los cambios.';
            showError(errorMessage);
        }
    } catch (error) {
        console.error('Error al actualizar el usuario', error);
        showError('Hubo un problema al conectar con el servidor.');
    }
}

$(document).ready(function () {
    $('#changePwBtn').click(function () {
        $('#passwordChangeModal').modal('show');
    });
});

$(document).ready(function () {
    $("#savePasswordBtn").click(async function () {
        event.preventDefault();

        // Validación de campos
        const fields = ["oldPassword", "newPassword"];
        if (!validateForm(fields)) {
            showWarning("Todos los campos deben ser completados.")
            return;
        }

        // Recolecta los datos del formulario y valida cada campo
        const formData = {
            oldPassword: $("#oldPassword").val().trim(),
            newPassword: $("#newPassword").val().trim()
        };

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=ProfilePage&action=changePassword', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        // Espera la respuesta del servidor en formato JSON
        const result = await response.json();

        if (result.success) {
            if (result.passwordMatch) {
                showSuccess('Tu contraseña ha sido actualizada correctamente.')
                $('#passwordChangeModal').modal('hide');
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
