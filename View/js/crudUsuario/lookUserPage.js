// Función para los filtros de la tabla
function filterTable() {
    // Obtener valores de los filtros
    let searchId = $('#searchId').val().trim();
    let searchRole = $('#searchRole').val();
    let searchUsername = $('#searchUsername').val().trim().toLowerCase();
    let searchFirstName = $('#searchFirstName').val().toLowerCase();
    let searchLastName = $('#searchLastName').val().toLowerCase();
    let searchEmail = $('#searchEmail').val().trim().toLowerCase();
    let searchPhone = $('#searchPhone').val().trim().toLowerCase();
    let searchStatus = $('#searchStatus').val().toLowerCase();

    let visibleRows = 0;

    // Iterar sobre cada fila de la tabla para aplicar los filtros
    $('#tablaUsuario tbody tr[id^="userRow-"]').each(function () {
        let isVisible = applyFiltersToRow($(this), {
            searchId, searchRole, searchUsername, searchFirstName,
            searchLastName, searchEmail, searchPhone, searchStatus
        });
        if (isVisible) visibleRows++;
    });

    // Mostrar u ocultar la fila "sin resultados" basada en la cantidad de filas visibles
    toggleNoResultRow(visibleRows);
}

// Función para aplicar los filtros a una fila específica
function applyFiltersToRow(row, filters) {
    let idText = row.children().eq(0).text().trim();
    let roleText = row.children().eq(1).text().trim().toLowerCase();
    let usernameText = row.children().eq(2).text().trim().toLowerCase();
    let firstNameText = row.children().eq(3).text().toLowerCase();
    let lastNameText = row.children().eq(4).text().toLowerCase();
    let emailText = row.children().eq(5).text().trim().toLowerCase();
    let phoneText = row.children().eq(6).text().trim().toLowerCase();
    let statusText = row.children().eq(7).text().trim().toLowerCase();

    let isRowVisible = (filters.searchId === "" || idText === filters.searchId) &&
        (filters.searchRole === "" || roleText === filters.searchRole) &&
        (filters.searchUsername === "" || usernameText.includes(filters.searchUsername)) &&
        (filters.searchFirstName === "" || firstNameText.includes(filters.searchFirstName)) &&
        (filters.searchLastName === "" || lastNameText.includes(filters.searchLastName)) &&
        (filters.searchEmail === "" || emailText.includes(filters.searchEmail)) &&
        (filters.searchPhone === "" || phoneText.includes(filters.searchPhone)) &&
        (filters.searchStatus === "" || statusText === filters.searchStatus);

    row.css('display', isRowVisible ? '' : 'none');
    return isRowVisible;
}

// Función para mostrar u ocultar la fila que indica que no hay resultados
function toggleNoResultRow(visibleRows) {
    const noResultRow = document.getElementById('no-result');
    noResultRow.style.display = visibleRows === 0 ? '' : 'none';
}

let sortOrder = 1; // 1 para ascendente, -1 para descendente
let currentSortColumn = null;

// Función para ordernar la tabla en función de la columna seleccionada
function sortTable(columnIndex, columnId) {
    // Obtiene la tabla y el cuerpo de la tabla
    const table = $('#tablaUsuario');
    const tbody = table.find('tbody').first();

    // Convierte las filas de la tabla en un array para poder ordenarlas
    let rows = tbody.find('tr:not(#no-result)').toArray();

    // Verifica si es necesario cambiar el icono de ordenamiento en la columna
    if (currentSortColumn && currentSortColumn !== columnId) {
        const previousArrowSpan = $('#' + currentSortColumn).find('.sort-arrow');
        previousArrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill'); // Limpia los iconos de ordenamiento
    }

    // Ordena las filas basándose en el texto de la celda y el orden actual
    rows.sort((a, b) => {
        let valA = $(a).find('td').eq(columnIndex).text().trim().toLowerCase();
        let valB = $(b).find('td').eq(columnIndex).text().trim().toLowerCase();

        // Convierte a número si es posible
        valA = !isNaN(valA) && !isNaN(parseFloat(valA)) ? parseFloat(valA) : valA;
        valB = !isNaN(valB) && !isNaN(parseFloat(valB)) ? parseFloat(valB) : valB;

        // Determina el orden de clasificación
        if (valA < valB) return -1 * sortOrder;
        if (valA > valB) return 1 * sortOrder;
        return 0;
    });

    // Alterna el orden para el próximo clic
    sortOrder *= -1;

    // Actualiza el icono de ordenación para mostrar la dirección actual
    const arrowSpan = $('#' + columnId).find('.sort-arrow');
    arrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill'); // Limpia los iconos anteriores
    if (sortOrder === 1) {
        arrowSpan.addClass('bi-caret-down-fill');
    } else {
        arrowSpan.addClass('bi-caret-up-fill');
    }

    // Guarda la columna actual como la última columna clickeada
    currentSortColumn = columnId;

    // Reinserta las filas en el cuerpo de la tabla en el orden nuevo
    rows.forEach(row => tbody.append(row));
}

// Agregando controladores de eventos para la ordenación al hacer clic en los encabezados de las columnas
$('#sortID').click(() => sortTable(0, 'sortID'));
$('#sortRol').click(() => sortTable(1, 'sortRol'));
$('#sortUsername').click(() => sortTable(2, 'sortUsername'));
$('#sortName').click(() => sortTable(3, 'sortName'));
$('#sortSurnames').click(() => sortTable(4, 'sortSurnames'));
$('#sortMail').click(() => sortTable(5, 'sortMail'));
$('#sortPhone').click(() => sortTable(6, 'sortPhone'));
$('#sortStatus').click(() => sortTable(7, 'sortStatus'));


// Función para poblar el dropdown de roles
async function populateRoleDropdown() {
    try {
        const roles = await getRoles();

        if (!roles) {
            console.error('No se recibieron los roles del servidor.');
            return;
        }

        const roleSelect = $('#searchRole');

        // Iterar sobre cada rol y añadirlo al dropdown
        roles.forEach(role => {
            // Crear un nuevo elemento option
            const option = $('<option></option>').val(role.nombre.toLowerCase()).text(role.nombre);
            // Añadir el option al select
            roleSelect.append(option);
        });
    } catch (error) {
        // Manejar cualquier error que ocurra durante la obtención o procesamiento de los roles
        console.error('Error al poblar el dropdown de roles:', error);
        showError('Ocurrió un error al cargar los roles.');
    }
}

// Llamar a la función cuando la página se carga.
document.addEventListener('DOMContentLoaded', populateRoleDropdown);

// Función que crea un usuario nuevo
async function createUserData() {

    // Validación de campos
    const createUserDataFields = ["newUsername", "newEmail", "newFirstName", "newLastName", "newPhone", "newPassword"];
    if (!validateForm(createUserDataFields)) {
        showWarning("Todos los campos deben ser completados.")
        return;
    }

    // Recolecta los datos del formulario y valida cada campo
    const formData = {
        role: $("#newUserRole").val().trim(),
        username: $("#newUsername").val().trim(),
        email: $("#newEmail").val().trim(),
        firstName: $("#newFirstName").val().trim(),
        lastName: $("#newLastName").val().trim(),
        phone: $("#newPhone").val().trim(),
        password: $("#newPassword").val().trim()
    };

    // Validación  para el correo electrónico
    if (!validateEmail(formData.email)) {
        $("#newEmail").css('border', '1px solid red');
        showError("¡Correo electrónico inválido!");
        return;
    }

    // Validación  para el nombre de usuario
    if (!validateUsername(formData.username)) {
        $("#newUsername").css('border', '1px solid red');
        showError("¡Nombre de usuario inválido! El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.");
        return;
    }

    try {
        // Realiza una solicitud POST al servidor.
        const url = './index.php?controller=LookUserPage&action=createUser';
        const result = await performAjaxRequest(url, 'POST', formData);

        if (result.success) {
            Swal.fire({
                title: '¡Éxito!',
                text: result.message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    localStorage.setItem('userCreated', 'true');  // Almacena un indicador en localStorage
                    window.location.reload();  // Recarga la página para mostrar los nuevos datos
                }
            });
        } else {
            if (result.error == 'correo') {
                $("#newEmail").css('border', '1px solid red');
            }
            if (result.error == 'usuario') {
                $("#newUsername").css('border', '1px solid red');
            }
            showError(result.message);
        }
    } catch (error) {
        console.error('Error al crear el usuario:', error);
        showError('Hubo un problema al conectar con el servidor.');
    }
}

// Función que modifica un usuario existente
async function updateUserData() {

    // Validación de campos
    const updateMeasureFields = ["username", "email", "firstName", "lastName", "phone",];
    if (!validateForm(updateMeasureFields)) {
        showWarning("Todos los campos deben ser completados.")
        return;
    }

    // Recolecta los valores de los campos del formulario
    const formData = {
        userId: $('#userId').val(),
        role: $('#userRole').val(),
        username: $('#username').val(),
        email: $('#email').val(),
        firstName: $('#firstName').val(),
        lastName: $('#lastName').val(),
        phone: $('#phone').val(),
        password: $('#password').val()
    };

    try {
        // Realiza una solicitud POST al servidor.
        const url = './index.php?controller=LookUserPage&action=updateUser';
        const result = await performAjaxRequest(url, 'POST', formData);

        if (result.success) {
            if (result.changed) {
                // Actualiza la interfaz de usuario con los nuevos datos
                updateUI(formData.userId, result.role, formData.username, formData.firstName, formData.lastName, formData.email, formData.phone);
            }
            let message = result.changed ? 'Los cambios fueron guardados con éxito.' : 'No se ingresaron cambios al usuario.';
            Swal.fire({
                title: '¡Éxito!',
                text: message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $('#editUserModal').modal('hide');
                }
            });
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


// Función que obtiene los datos de un usuario basándose en su ID
async function getUserData(userId) {
    const formData = new URLSearchParams();
    formData.append('userId', userId);

    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=getUserData', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const result = await response.json();
        return result;

    } catch (error) {
        console.error('Ha ocurrido un problema con la operación fetch:', error);
        return null;
    }
}

// Función para obtener los roles desde el servidor
async function getRoles() {
    try {
        // Realizar el GET para obtener los roles
        const response = await fetch('./index.php?controller=LookUserPage&action=getRoles', {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud HTTP: Estado ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Ha ocurrido un problema con la operación fetch:', error);
        return [];
    }
}

// Función para actualizar la interfaz de usuario con los nuevos datos
function updateUI(userId, role, username, firstName, lastName, email, phone) {
    $(`#userRole-${userId}`).text(role);
    $(`#username-${userId}`).text(username);
    $(`#firstName-${userId}`).text(firstName);
    $(`#lastName-${userId}`).text(lastName);
    $(`#email-${userId}`).text(email);
    $(`#phone-${userId}`).text(phone);
}

// Función que genera una contraseña aleatoria
function generateRandomPassword(length) {
    // Define los caracteres que se utilizarán para generar la contraseña
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%';
    let result = '';

    for (let i = 0; i < length; i++) {
        // Selecciona un carácter aleatorio de la cadena de caracteres y lo añade al resultado
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}


// Botones de activación/desactivación de usuarios
$(document).ready(function () {
    $('.btn-toggle').on('click', async function () {
        // Recuperar datos necesarios del elemento al que se le hizo click
        const userId = $(this).attr('data-user-id');
        const username = $(this).attr('data-user-name');
        const currentState = $(this).attr('data-state');
        const action = currentState === 'activo' ? 'deactivate' : 'activate';

        try {
            // Realiza una solicitud POST al servidor.
            const url = `./index.php?controller=LookUserPage&action=${action}`;
            const result = await performAjaxRequest(url, 'POST', {userId: userId});

            if (result.success) {
                $(this).attr('data-state', action === 'activate' ? 'activo' : 'inactivo');
                $(this).text(currentState === 'activo' ? 'Inactivo' : 'Activo');

                Swal.fire({
                    icon: result.icon,
                    title: result.title,
                    text: `El usuario ${username} ha sido ${currentState === 'activo' ? 'desactivado' : 'activado'} con éxito.`,
                    confirmButtonColor: 'rgb(29, 29, 29)',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                showError('No se pudo cambiar el estado del usuario.');
            }
        } catch (error) {
            console.error('Error al actualizar el estado del usuario', error);
            showError('Hubo un problema al conectar con el servidor.');
        }
    });
});


// Botones de modificar usuario
$(document).ready(function () {
    $('.edit-user-btn').on('click', async function () {
        // Obtener el ID del usuario y recuperar sus datos y roles
        const userId = $(this).attr('data-user-id');
        const userData = await getUserData(userId);
        const roles = await getRoles();

        // Resetear estilos para indicación de error, si existen
        $("#email, #username").css('border', '');

        // Limpia las opciones existentes y rellena el dropdown con los roles disponibles
        const roleSelect = $('#userRole').empty();
        roles.forEach(role => roleSelect.append($('<option></option>').val(role.id).text(role.nombre)));

        // Si se obtuvieron datos del usuario, actualiza los campos del formulario
        if (userData) {
            $('#userId').val(userData.id);
            $('#userRole').val(userData.rol);
            $('#username').val(userData.username);
            $('#firstName').val(userData.nombre);
            $('#lastName').val(userData.apellidos);
            $('#email').val(userData.correo);
            $('#phone').val(userData.telefono);
            $('#userProfileImage').attr('src', userData.ruta_imagen || './View/img/users/default_user.png');
            $('#password').val("");
        }
    });
});


// Botón de crear usuario
$(document).ready(function () {
    $('.add-user-btn').on('click', async function () {
        // Obtener y mostrar los roles disponibles para un nuevo usuario
        const roles = await getRoles();

        // Resetear estilos de error, si existen
        $("#email, #username").css('border', '');

        // Preparar y llenar el dropdown de roles
        const roleSelect = $('#newUserRole').empty();
        roles.forEach(role => roleSelect.append($('<option></option>').val(role.id).text(role.nombre)));

        // Limpiar el campo de contraseña
        $('#contrasena').val("");
    });
});


// Botón para generar contraseña aleatoria
$(document).ready(function () {
    $('.btn-shuffle-pw').on('click', function () {
        const passwordFieldId = $(this).attr('data-password-field');
        const newPassword = generateRandomPassword(12);
        const passwordField = $(`#${passwordFieldId}`);

        // Muestra la nueva contraseña y oculta después de un intervalo
        passwordField.attr('type', 'text').val(newPassword);
        setTimeout(() => passwordField.attr('type', 'password'), 5000);
    });
});
