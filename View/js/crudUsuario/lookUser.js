function filterTable() {
    // Valores de los filtros
    const searchId = document.getElementById('searchId').value.trim();
    const searchRole = document.getElementById('searchRole').value;
    const searchUsername = document.getElementById('searchUsername').value.trim().toLowerCase();
    const searchFirstName = document.getElementById('searchFirstName').value.toLowerCase();
    const searchLastName = document.getElementById('searchLastName').value.toLowerCase();
    const searchEmail = document.getElementById('searchEmail').value.trim().toLowerCase();
    const searchPhone = document.getElementById('searchPhone').value.trim().toLowerCase();
    const searchStatus = document.getElementById('searchStatus').value.toLowerCase();

    let visibleRows = 0;

    // Solo aplica la lógica de filtrado a las filas con id que comienza con 'userRow-' (ignora la fila de "sin resultados")
    document.querySelectorAll('#tablaUsuario tbody tr[id^="userRow-"]').forEach(row => {
        const idText = row.children[0].textContent.trim();
        const roleText = row.children[1].textContent.trim().toLowerCase();
        const usernameText = row.children[2].textContent.trim().toLowerCase();
        const firstNameText = row.children[3].textContent.toLowerCase();
        const lastNameText = row.children[4].textContent.toLowerCase();
        const emailText = row.children[5].textContent.trim().toLowerCase();
        const phoneText = row.children[6].textContent.trim().toLowerCase();
        const statusText = row.children[7].textContent.trim().toLowerCase();

        const isRowVisible = (searchId === "" || idText === searchId) &&
            (searchRole === "" || roleText === searchRole) &&
            (searchUsername === "" || usernameText.includes(searchUsername)) &&
            (searchFirstName === "" || firstNameText.includes(searchFirstName)) &&
            (searchLastName === "" || lastNameText.includes(searchLastName)) &&
            (searchEmail === "" || emailText.includes(searchEmail)) &&
            (searchPhone === "" || phoneText.includes(searchPhone)) &&
            (searchStatus === "" || statusText === searchStatus);

        row.style.display = isRowVisible ? '' : 'none';
        if (isRowVisible) visibleRows++;
    });

    // Comprueba si hay filas visibles y muestra u oculta la fila "sin resultado"
    const noResultRow = document.getElementById('no-result');
    noResultRow.style.display = visibleRows === 0 ? '' : 'none';
}


let sortOrder = 1; // 1 para ascendente, -1 para descendente
let currentSortColumn = null;

function sortTable(columnIndex, columnId) {
    const table = document.getElementById('tablaUsuario');
    const tbody = table.getElementsByTagName('tbody')[0];
    let rows = Array.from(tbody.rows);

    // Remueve el icono de flecha del anterior th, si existe
    if (currentSortColumn && currentSortColumn !== columnId) {
        const previousArrowSpan = document.getElementById(currentSortColumn).querySelector('.sort-arrow');
        previousArrowSpan.classList.remove('bi-caret-up-fill', 'bi-caret-down-fill'); // Remueve las clases de iconos
    }

    rows.sort((a, b) => {
        let cellA = a.cells[columnIndex].textContent.trim().toLowerCase();
        let cellB = b.cells[columnIndex].textContent.trim().toLowerCase();

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
    const arrowSpan = document.getElementById(columnId).querySelector('.sort-arrow');

    // Limpia las clases previas
    arrowSpan.classList.remove('bi-caret-up-fill', 'bi-caret-down-fill');

    // Agrega la clase correspondiente al estado del orden
    if (sortOrder === 1) {
        arrowSpan.classList.add('bi-caret-down-fill');
    } else {
        arrowSpan.classList.add('bi-caret-up-fill');
    }

    // Guarda el th actual como el último clickeado
    currentSortColumn = columnId;

    // Reinserta las filas ordenadas
    rows.forEach(row => tbody.appendChild(row));
}

// Agrega el controlador de eventos al th (ordenamiento)
document.getElementById('sortID').addEventListener('click', () => sortTable(0, 'sortID'));
document.getElementById('sortRol').addEventListener('click', () => sortTable(1, 'sortRol'));
document.getElementById('sortUsername').addEventListener('click', () => sortTable(2, 'sortUsername'));
document.getElementById('sortName').addEventListener('click', () => sortTable(3, 'sortName'));
document.getElementById('sortSurnames').addEventListener('click', () => sortTable(4, 'sortSurnames'));
document.getElementById('sortMail').addEventListener('click', () => sortTable(5, 'sortMail'));
document.getElementById('sortPhone').addEventListener('click', () => sortTable(6, 'sortPhone'));
document.getElementById('sortStatus').addEventListener('click', () => sortTable(7, 'sortStatus'));


async function populateRoleDropdown() {
    const roles = await getRoles();
    const roleSelect = document.getElementById('searchRole');
    roles.forEach(role => {
        const option = document.createElement('option');
        option.value = role.nombre.toLowerCase();
        option.textContent = role.nombre;
        roleSelect.appendChild(option);
    });
}

// Llamar a la función cuando la página se carga.
document.addEventListener('DOMContentLoaded', populateRoleDropdown);


document.querySelectorAll('.btn-toggle').forEach(button => {
    button.addEventListener('click', async function () {

        const userId = this.getAttribute('data-user-id');
        const username = this.getAttribute('data-user-name');
        const action = this.getAttribute('data-state') === 'activo' ? 'deactivate' : 'activate';

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
                // Actualizar el estado del botón y el texto.
                this.setAttribute('data-state', action === 'activate' ? 'activo' : 'inactivo');
                // Actualizar el texto del botón basado en el nuevo estado
                this.textContent = this.getAttribute('data-state') === 'activo' ? 'Activo' : 'Inactivo';

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
});


document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', async function () {
        const userId = this.getAttribute('data-user-id');
        const userData = await getUserData(userId);
        const roles = await getRoles();

        const roleSelect = document.getElementById('userRole');
        roleSelect.innerHTML = ''; // Limpia las opciones existentes

        // Llena el dropdown con los roles
        roles.forEach(role => {
            const option = document.createElement('option');
            option.value = role.id;
            option.textContent = role.nombre;
            roleSelect.appendChild(option);
        });

        if (userData) {
            document.getElementById('userId').value = userData.id;
            roleSelect.value = userData.rol;
            document.getElementById('username').value = userData.username;
            document.getElementById('firstName').value = userData.nombre;
            document.getElementById('lastName').value = userData.apellidos;
            document.getElementById('email').value = userData.correo;
            document.getElementById('phone').value = userData.telefono;
            document.getElementById('userProfileImage').src = userData.ruta_imagen || './View/img/users/default_user.png';
        }
    });
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

async function saveUserData() {
    const userId = document.getElementById('userId').value;
    const username = document.getElementById('username').value;
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const role = document.getElementById('userRole').value;

    const formData = new URLSearchParams();
    formData.append('userId', userId);
    formData.append('username', username);
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('role', role);

    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=updateUser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            document.getElementById(`userId-${userId}`).textContent = userId;
            document.getElementById(`userRole-${userId}`).textContent = rolesMap[role];
            document.getElementById(`username-${userId}`).textContent = username;
            document.getElementById(`firstName-${userId}`).textContent = firstName;
            document.getElementById(`lastName-${userId}`).textContent = lastName;
            document.getElementById(`email-${userId}`).textContent = email;
            document.getElementById(`phone-${userId}`).textContent = phone;

            Swal.fire({
                title: '¡Éxito!',
                text: 'Los cambios fueron guardados con éxito.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        } else {
            Swal.fire({
                title: 'Error',
                text: result.message || 'Hubo un problema al guardar los cambios.',
                icon: 'error',
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


