$(document).ready(function () {
    // Al hacer clic en el botón de registro, se ejecuta esta función.
    $("#signUpBtn").click(async function (event) {
        event.preventDefault();

        // Limpiar border rojos (si existen)
        $("#firstName, #lastName, #email, #username, #phone, #password").css('border', '');

        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var phone = $("#phone").val();
        var password = $("#password").val();

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#firstName, #lastName, #email, #username, #phone, #password").each(function () {
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

        // Validación del email electrónico
        var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regexCorreo.test(email)) {
            $("#email").css('border', '1px solid red');
            Swal.fire({
                title: "¡Correo electrónico inválido!",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;// Detiene la ejecución si el email no es válido
        }

        // Validación del firstName de username
        var regexUsuario = /^[a-zA-Z0-9_-]+$/;
        if (!regexUsuario.test(username)) {
            $("#username").css('border', '1px solid red');

            Swal.fire({
                title: "¡Nombre de username inválido!",
                text: "El firstName de username solo puede contener letras, números, guiones y guiones bajos.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;// Detiene la ejecución si el username no es válido
        }

        // Validación de la contraseña
        var regexContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (!regexContrasena.test(password)) {
            $("#password").css('border', '1px solid red');

            Swal.fire({
                title: "¡Contraseña inválida!",
                text: "La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;// Detiene la ejecución si la contraseña
        }

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const response = await fetch('./index.php?controller=SignUpPage&action=SignUp', {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                username: username,
                password: password,
                firstName: firstName,
                lastName: lastName,
                email: email,
                phone: phone
            })
        });

        const result = await response.json();

        console.log(result)

        // Si la respuesta es exitosa, redirige al username a la página principal.
        if (result.success) {
            location.href = './index.php?controller=indexPage&action=index';
        } else {
            if (result.error == 'correo') {
                $("#email").css('border', '1px solid red');
            }
            if (result.error == 'usuario') {
                $("#username").css('border', '1px solid red');
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
        var tipo = $("#password").attr("type");
        var icon = $(this).find('i'); // Encuentra el ícono dentro del botón

        // Cambia el tipo del campo y alterna entre los íconos
        if (tipo === "password") {
            $("#password").attr("type", "text");
            icon.removeClass('bi-eye-slash').addClass('bi-eye'); // Cambia al ícono de ojo abierto
        } else {
            $("#password").attr("type", "password");
            icon.removeClass('bi-eye').addClass('bi-eye-slash'); // Cambia al ícono de ojo cerrado
        }
    });
});

