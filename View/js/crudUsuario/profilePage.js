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
            updateUI(userId, firstName, lastName, email, phone);
            let message = result.changed ? 'Los cambios fueron guardados con éxito.' : 'No se ingresaron cambios al usuario.';
            Swal.fire({
                title: '¡Éxito!',
                text: message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
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

function updateUI(userId, firstName, lastName, email, phone) {
    $(`#firstName-${userId}`).text(firstName);
    $(`#lastName-${userId}`).text(lastName);
    $(`#email-${userId}`).text(email);
    $(`#phone-${userId}`).text(phone);
}