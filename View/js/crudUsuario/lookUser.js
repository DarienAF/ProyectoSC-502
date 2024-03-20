function filterTable() {
    const searchId = document.getElementById('searchId').value;
    const searchRole = document.getElementById('searchRole').value;
    const searchUsername = document.getElementById('searchUsername').value.trim().toLowerCase();
    const searchFirstName = document.getElementById('searchFirstName').value.toLowerCase();
    const searchLastName = document.getElementById('searchLastName').value.toLowerCase();
    const searchEmail = document.getElementById('searchEmail').value.toLowerCase();
    const searchPhone = document.getElementById('searchPhone').value.toLowerCase();
    const searchStatus = document.getElementById('searchStatus').value.trim().toLowerCase();
    ;

    document.querySelectorAll('#tablaUsuario tbody tr').forEach(row => {
        const idText = row.children[0].textContent;
        const roleText = row.children[1].textContent.trim().toLowerCase();
        const usernameText = row.children[2].textContent.toLowerCase();
        const firstNameText = row.children[3].textContent.toLowerCase();
        const lastNameText = row.children[4].textContent.toLowerCase();
        const emailText = row.children[5].textContent.toLowerCase();
        const phoneText = row.children[6].textContent.toLowerCase();
        const statusText = row.children[7].textContent.trim().toLowerCase();

        row.style.display = (searchId === "" || idText === searchId) &&
        (searchRole === "" || roleText === searchRole) &&
        (searchUsername === "" || usernameText.includes(searchUsername)) &&
        (searchFirstName === "" || firstNameText.includes(searchFirstName)) &&
        (searchLastName === "" || lastNameText.includes(searchLastName)) &&
        (searchEmail === "" || emailText.includes(searchEmail)) &&
        (searchPhone === "" || phoneText.includes(searchPhone)) &&
        (searchStatus === "" || statusText === searchStatus) ? '' : 'none';
    });
}


async function populateRoleDropdown() {
    const roles = await getRoles();
    const roleSelect = document.getElementById('searchRole');
    roles.forEach(role => {
        const option = document.createElement('option');
        option.value = role.nombre.toLowerCase(); // Aquí estamos asumiendo que los roles se buscan por nombre, no por ID.
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
            const data = await response.json(); // Asumiendo que la respuesta es JSON.

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
            document.getElementById('userProfileImage').src = userData.ruta_imagen || 'ruta/a/imagen/por/defecto.png';
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

        // Suponemos que la respuesta incluye los datos del usuario.
        return data;
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
}

async function getRoles() {
    try {
        const response = await fetch('./index.php?controller=LookUserPage&action=getRoles', { // Ajusta la URL según tu implementación
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
            // Actualiza los valores en la fila
            document.getElementById(`userId-${userId}`).textContent = userId;
            document.getElementById(`userRole-${userId}`).textContent = rolesMap[role];
            document.getElementById(`username-${userId}`).textContent = username;
            document.getElementById(`firstName-${userId}`).textContent = firstName;
            document.getElementById(`lastName-${userId}`).textContent = lastName;
            document.getElementById(`email-${userId}`).textContent = email;
            document.getElementById(`phone-${userId}`).textContent = phone;

            // Muestra un Sweet Alert
            Swal.fire({
                title: '¡Éxito!',
                text: 'Los cambios fueron guardados con éxito.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        } else {
            // Mostrar un mensaje de error si la actualización falla
            Swal.fire({
                title: 'Error',
                text: result.message || 'Hubo un problema al guardar los cambios.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al actualizar el usuario:', error);
        // Mostrar un mensaje de error si la solicitud falla
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al conectar con el servidor.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
}


