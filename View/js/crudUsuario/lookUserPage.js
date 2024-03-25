function filterTable() {
    // Valores de los filtros
    var searchId = $('#searchId').val().trim();
    var searchRole = $('#searchRole').val();
    var searchUsername = $('#searchUsername').val().trim().toLowerCase();
    var searchFirstName = $('#searchFirstName').val().toLowerCase();
    var searchLastName = $('#searchLastName').val().toLowerCase();
    var searchEmail = $('#searchEmail').val().trim().toLowerCase();
    var searchPhone = $('#searchPhone').val().trim().toLowerCase();
    var searchStatus = $('#searchStatus').val().toLowerCase();


    let visibleRows = 0;

    // Solo aplica la lógica de filtrado a las filas con id que comienza con 'userRow-' (ignora la fila de "sin resultados")
    $('#tablaUsuario tbody tr[id^="userRow-"]').each(function () {
        var row = $(this);
        var idText = row.children().eq(0).text().trim();
        var roleText = row.children().eq(1).text().trim().toLowerCase();
        var usernameText = row.children().eq(2).text().trim().toLowerCase();
        var firstNameText = row.children().eq(3).text().toLowerCase();
        var lastNameText = row.children().eq(4).text().toLowerCase();
        var emailText = row.children().eq(5).text().trim().toLowerCase();
        var phoneText = row.children().eq(6).text().trim().toLowerCase();
        var statusText = row.children().eq(7).text().trim().toLowerCase();

        var isRowVisible = (searchId === "" || idText === searchId) &&
            (searchRole === "" || roleText === searchRole) &&
            (searchUsername === "" || usernameText.includes(searchUsername)) &&
            (searchFirstName === "" || firstNameText.includes(searchFirstName)) &&
            (searchLastName === "" || lastNameText.includes(searchLastName)) &&
            (searchEmail === "" || emailText.includes(searchEmail)) &&
            (searchPhone === "" || phoneText.includes(searchPhone)) &&
            (searchStatus === "" || statusText === searchStatus);

        row.css('display', isRowVisible ? '' : 'none');
        if (isRowVisible) visibleRows++;
    });


    // Comprueba si hay filas visibles y muestra u oculta la fila "sin resultado"
    const noResultRow = document.getElementById('no-result');
    noResultRow.style.display = visibleRows === 0 ? '' : 'none';
}


let sortOrder = 1; // 1 para ascendente, -1 para descendente
let currentSortColumn = null;

function sortTable(columnIndex, columnId) {
    const table = $('#tablaUsuario');
    const tbody = table.find('tbody').first();
    let rows = tbody.find('tr:not(#no-result)').toArray();

    // Remueve el icono de flecha del anterior th, si existe
    if (currentSortColumn && currentSortColumn !== columnId) {
        const previousArrowSpan = $('#' + currentSortColumn).find('.sort-arrow');
        previousArrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill'); // Remueve las clases de iconos
    }

    rows.sort((a, b) => {
        let cellA = $(a).find('td').eq(columnIndex).text().trim().toLowerCase();
        let cellB = $(b).find('td').eq(columnIndex).text().trim().toLowerCase();

        cellA = !isNaN(cellA) && !isNaN(parseFloat(cellA)) ? parseFloat(cellA) : cellA;
        cellB = !isNaN(cellB) && !isNaN(parseFloat(cellB)) ? parseFloat(cellB) : cellB;

        if (cellA < cellB) {
            return -1 * sortOrder;
        }
        if (cellA > cellB) {
            return 1 * sortOrder;
        }
        return 0;
    });

    sortOrder *= -1; // Invierte la dirección del orden para el próximo click

    // Actualiza la flecha en el th actual
    const arrowSpan = $('#' + columnId).find('.sort-arrow');

    // Limpia las clases previas
    arrowSpan.removeClass('bi-caret-up-fill bi-caret-down-fill');

    // Agrega la clase correspondiente al estado del orden
    if (sortOrder === 1) {
        arrowSpan.addClass('bi-caret-down-fill');
    } else {
        arrowSpan.addClass('bi-caret-up-fill');
    }

    // Guarda el th actual como el último clickeado
    currentSortColumn = columnId;

    // Reinserta las filas ordenadas
    rows.forEach(row => tbody.append(row));
}

// Agrega el controlador de eventos al th (ordenamiento)
$('#sortID').click(() => sortTable(0, 'sortID'));
$('#sortRol').click(() => sortTable(1, 'sortRol'));
$('#sortUsername').click(() => sortTable(2, 'sortUsername'));
$('#sortName').click(() => sortTable(3, 'sortName'));
$('#sortSurnames').click(() => sortTable(4, 'sortSurnames'));
$('#sortMail').click(() => sortTable(5, 'sortMail'));
$('#sortPhone').click(() => sortTable(6, 'sortPhone'));
$('#sortStatus').click(() => sortTable(7, 'sortStatus'));

async function populateRoleDropdown() {
    const roles = await getRoles();
    const roleSelect = $('#searchRole');
    roles.forEach(role => {
        const option = $('<option></option>').val(role.nombre.toLowerCase()).text(role.nombre);
        roleSelect.append(option);
    });
}

// Llamar a la función cuando la página se carga.
document.addEventListener('DOMContentLoaded', populateRoleDropdown);

$('.btn-toggle').on('click', async function () {
    const userId = $(this).attr('data-user-id');
    const username = $(this).attr('data-user-name');
    const action = $(this).attr('data-state') === 'activo' ? 'deactivate' : 'activate';

    const formData = new URLSearchParams();
    formData.append('userId', userId);

    try {
        const response = await fetch(`./index.php?controller=LookUserPage&action=${action}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            $(this).attr('data-state', action === 'activate' ? 'activo' : 'inactivo');
            $(this).text($(this).attr('data-state') === 'activo' ? 'Activo' : 'Inactivo');

            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: "El usuario " + username + " ha sido " + data.text + " con éxito.",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        } else {
            Swal.fire({
                title: "No se pudo cambiar el estado del usuario.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        Swal.fire({
            title: "Ocurrió un error al intentar cambiar el estado del usuario.",
            icon: "error",
            confirmButtonColor: 'rgb(29, 29, 29)',
            confirmButtonText: 'Aceptar'
        });
    }
});


$('.edit-user-btn').on('click', async function () {
    const userId = $(this).attr('data-user-id');
    const userData = await getUserData(userId);
    const roles = await getRoles();

    // Limpiar border rojos (si existen)
    $("#email, #username").css('border', '');

    const roleSelect = $('#userRole');
    roleSelect.empty(); // Limpia las opciones existentes

    // Llena el dropdown con los roles
    roles.forEach(role => {
        const option = $('<option></option>').val(role.id).text(role.nombre);
        roleSelect.append(option);
    });

    if (userData) {
        $('#userId').val(userData.id);
        roleSelect.val(userData.rol);
        $('#username').val(userData.username);
        $('#firstName').val(userData.nombre);
        $('#lastName').val(userData.apellidos);
        $('#email').val(userData.correo);
        $('#phone').val(userData.telefono);
        $('#userProfileImage').attr('src', userData.ruta_imagen || './View/img/users/default_user.png');
        $('#password').val("");
    }
});


$('.add-user-btn').on('click', async function () {
    const roles = await getRoles();

    // Limpiar border rojos (si existen)
    $("#email, #username").css('border', '');

    const roleSelect = $('#newUserRole');
    roleSelect.empty(); // Limpia las opciones existentes

    // Llena el dropdown con los roles
    roles.forEach(role => {
        const option = $('<option></option>').val(role.id).text(role.nombre);
        roleSelect.append(option);
    });

    $('#contrasena').val(""); // Limpia el campo contraseña
});


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

        const data = await response.json();

        return data;
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
}

async function getRoles() {
    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=getRoles', {
            method: 'GET',
        });

        return await response.json();
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
}


async function createUserData() {
    // Limpiar border rojos (si existen)
    $("#Nombre, #Apellidos, #correoElectronico, #nombreUsuario, #numeroContacto, #Contrasena").css('border', '');


    var isFormValid = true;

    const userData = {
        role: $("#newUserRole").val() || markInvalid('newUserRole'),
        username: $("#newUsername").val() || markInvalid('newUsername'),
        email: $("#newEmail").val() || markInvalid('newEmail'),
        firstName: $("#newFirstName").val() || markInvalid('newFirstName'),
        lastName: $("#newLastName").val() || markInvalid('newLastName'),
        phone: $("#newPhone").val() || markInvalid('newPhone'),
        password: $("#newPassword").val() || markInvalid('newPassword')
    };

    function markInvalid(id) {
        $(`#${id}`).css('border', '1px solid red');
        isFormValid = false;
        return null;
    }


    if (!isFormValid) {
        Swal.fire({
            title: "Todos los campos deben ser completados.",
            icon: "warning",
            confirmButtonColor: 'rgb(29, 29, 29)',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    // Validación del correo electrónico
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!regexCorreo.test(userData['email'])) {
        $("#newEmail").css('border', '1px solid red');
        Swal.fire({
            title: "¡Correo electrónico inválido!",
            icon: "error",
            confirmButtonColor: 'rgb(29, 29, 29)',
            confirmButtonText: 'Aceptar'
        });
        return;// Detiene la ejecución si el email no es válido
    }

    // Validación del nombre de usuario
    var regexUsuario = /^[a-zA-Z0-9_-]+$/;
    if (!regexUsuario.test(userData['username'])) {
        $("#newUsername").css('border', '1px solid red');

        Swal.fire({
            title: "¡Nombre de usuario inválido!",
            text: "El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.",
            icon: "error",
            confirmButtonColor: 'rgb(29, 29, 29)',
            confirmButtonText: 'Aceptar'
        });
        return;// Detiene la ejecución si el nombre de usuario no es válido
    }

    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=createUser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userData)
        });

        const result = await response.json();


        if (result.success) {
            localStorage.setItem('userCreated', 'true');
            window.location.reload();
        } else {
            if (result.error == 'correo') {
                $("#newEmail").css('border', '1px solid red');
            }
            if (result.error == 'usuario') {
                $("#newEmail").css('border', '1px solid red');
            }
            // Si hay un error, muestra un mensaje y no redirige.
            Swal.fire({
                title: "¡Hubo un error!",
                text: result.message,
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al actualizar el usuario:', error);
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al conectar con el servidor.',
            icon: 'error',
            confirmButtonColor: 'rgb(29, 29, 29)',
            confirmButtonText: 'Aceptar'
        });
    }
}

async function updateUserData() {
    const userId = $('#userId').val();
    const role = $('#userRole').val();
    const username = $('#username').val();
    const firstName = $('#firstName').val();
    const lastName = $('#lastName').val();
    const email = $('#email').val();
    const phone = $('#phone').val();
    const password = $('#password').val();

    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=updateUser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userId: userId,
                role: role,
                username: username,
                firstName: firstName,
                lastName: lastName,
                email: email,
                phone: phone,
                password: password
            })
        });

        const result = await response.json();

        if (result.success) {
            $(`#userRole-${userData.userId}`).text(rolesMap[userData.role]);
            $(`#username-${userData.userId}`).text(userData.username);
            $(`#firstName-${userData.userId}`).text(userData.firstName);
            $(`#lastName-${userData.userId}`).text(userData.lastName);
            $(`#email-${userData.userId}`).text(userData.email);
            $(`#phone-${userData.userId}`).text(userData.phone);

            $('#editUserModal').modal('hide');

            if (result.changed) {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Los cambios fueron guardados con éxito.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            } else {
                Swal.fire({
                    title: 'Sin cambios',
                    text: 'No se ingresaron cambios al usuario.',
                    icon: 'info',
                    confirmButtonText: 'Aceptar'
                })
            }
        } else {
            if (result.error == 'usuario') {
                $("#username").css('border', '1px solid red');
            } else if (result.error == 'correo') {
                $("#email").css('border', '1px solid red');
            }

            // Configura el mensaje de error según el tipo de error
            let errorMessage = result.message || 'Hubo un problema al guardar los cambios.';
            let errorIcon = 'error';

            if (result.error == 'usuario' || result.error == 'correo') {
                errorIcon = 'warning';
            }

            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: errorIcon,
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al actualizar el usuario:', error);
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al conectar con el servidor.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
}

$(document).ready(function () {
    $('.btn-shuffle-pw').on('click', function () {
        const passwordFieldId = $(this).attr('data-password-field');
        const newPassword = generateRandomPassword(12);
        const passwordField = $(`#${passwordFieldId}`);
        passwordField.attr('type', 'text').val(newPassword);

        setTimeout(() => {
            passwordField.attr('type', 'password');
        }, 5000);
    });
});


function generateRandomPassword(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}
