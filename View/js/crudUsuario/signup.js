$(document).ready(function () {
    // Al hacer clic en el botón de registro, se ejecuta esta función.
    $("#signUpBtn").click(async function (event) {
        event.preventDefault();

        var nombre = $("#Nombre").val();
        var apellidos = $("#Apellidos").val();
        var correo = $("#correoElectronico").val();
        var usuario = $("#nombreUsuario").val();
        var numero = $("#numeroContacto").val();
        var contrasena = $("#Contrasena").val();

        // Limpiar border rojos (si existen)
        $("#Nombre, #Apellidos, #correoElectronico, #nombreUsuario, #numeroContacto, #Contrasena").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#Nombre, #Apellidos, #correoElectronico, #nombreUsuario, #numeroContacto, #Contrasena").each(function () {
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

        // Validación del correo electrónico
        var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regexCorreo.test(correo)) {
            $("#correoElectronico").css('border', '1px solid red');
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
        if (!regexUsuario.test(usuario)) {
            $("#nombreUsuario").css('border', '1px solid red');

            Swal.fire({
                title: "¡Nombre de usuario inválido!",
                text: "El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;// Detiene la ejecución si el nombre de usuario no es válido
        }

        // Validación de la contraseña
        var regexContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (!regexContrasena.test(contrasena)) {
            $("#Contrasena").css('border', '1px solid red');

            Swal.fire({
                title: "¡Contraseña inválida!",
                text: "La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;// Detiene la ejecución si el nombre de usuario no es válido
        }


        const userData = {
            nombre: nombre,
            apellidos: apellidos,
            correo: correo,
            usuario: usuario,
            numero: numero,
            contraseña: contrasena
        };

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=SignUpPage&action=SignUp', {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({userData}),
        });

        const result = await response.json();

        // Si la respuesta es exitosa, redirige al usuario a la página principal.
        if (result.success) {
            location.href = './index.php?controller=indexPage&action=index';
        } else {
            if (result.error == 'correo') {
                $("#correoElectronico").css('border', '1px solid red');
            }
            if (result.error == 'usuario') {
                $("#nombreUsuario").css('border', '1px solid red');
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
    });
});

$(document).ready(function () {
    $("#togglePassword").click(function () {
        // Verifica el tipo actual del campo de contraseña
        var tipo = $("#Contrasena").attr("type");
        var icon = $(this).find('i'); // Encuentra el ícono dentro del botón

        // Cambia el tipo del campo y alterna entre los íconos
        if (tipo === "password") {
            $("#Contrasena").attr("type", "text");
            icon.removeClass('bi-eye-slash').addClass('bi-eye'); // Cambia al ícono de ojo abierto
        } else {
            $("#Contrasena").attr("type", "password");
            icon.removeClass('bi-eye').addClass('bi-eye-slash'); // Cambia al ícono de ojo cerrado
        }
    });
});

