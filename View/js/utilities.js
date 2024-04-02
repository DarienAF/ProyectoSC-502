async function performAjaxRequest(url, method, data, headers = {'Content-Type': 'application/json'}) {
    try {
        const response = await fetch(url, {
            method: method,
            headers: headers,
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Error realizando el fetch:', error);
        showError('Error al ralizar fetch al servidor.');
    }
}

// Función para validar blancos en formularios
function validateForm(fields) {
    let isFormValid = true;
    fields.forEach(fieldId => {
        const field = $(`#${fieldId}`);
        // Revisar si el campo esta lleno
        if (!field.val()) {
            field.css('border', '1px solid red');
            isFormValid = false;
        } else {
            field.css('border', '');
        }
    });
    return isFormValid;
}

// Función para validar el formato del correo electrónico
function validateEmail(email) {
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regexEmail.test(email);
}

// Función para validar el nombre de usuario
function validateUsername(username) {
    let regexUsername = /^[a-zA-Z0-9_-]+$/;
    return regexUsername.test(username);
}

// Función para validar la contraseña
function validatePassword(password) {
    let regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return regexPassword.test(password);
}

// Funciónes para mostrar sweetAlerts
function showError(message) {
    Swal.fire({
        title: 'Error',
        text: message,
        icon: 'error',
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    });
}

function showWarning(message) {
    Swal.fire({
        title: message,
        icon: 'warning',
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    });
}

function showSuccess(message) {
    Swal.fire({
        title: "Éxito",
        text: message,
        icon: 'success',
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    });
}

function showSuccessAndRedirect(message, route) {
    Swal.fire({
        title: "Éxito",
        text: message,
        icon: 'success',
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            window.location.href = route
        }
    });
}

function showSuccessAndReload(message) {
    Swal.fire({
        title: "Éxito",
        text: message,
        icon: 'success',
        confirmButtonColor: 'rgb(29, 29, 29)',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            window.location.reload()
        }
    });
}



