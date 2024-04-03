$(document).ready(function () {
    // Al hacer clic en el botón de registro, se ejecuta esta función.
    $("#signUpBtn").click(async function (event) {
        event.preventDefault();

        // Validación de campos
        const fields = ["firstName", "lastName", "email", "username", "phone", "password"];
        if (!validateForm(fields)) {
            showWarning("Todos los campos deben ser completados.");
            return;
        }

        // Recolecta los datos del formulario y valida cada campo
        const formData = {
            firstName: $("#firstName").val().trim(),
            lastName: $("#lastName").val().trim(),
            email: $("#email").val().trim(),
            username: $("#username").val().trim(),
            phone: $("#phone").val().trim(),
            password: $("#password").val().trim()
        };

        // Validación  para el correo electrónico
        if (!validateEmail(formData.email)) {
            $("#email").css('border', '1px solid red');
            showError("¡Correo electrónico inválido!");
            return;
        }

        // Validación del firstName de username
        if (!validateUsername(formData.username)) {
            $("#username").css('border', '1px solid red');
            showError("¡Correo electrónico inválido!");
            return;
        }

        // Validación de la contraseña
        if (!validatePassword(formData.password)) {
            $("#password").css('border', '1px solid red');
            showError("¡Correo electrónico inválido!");
            return;
        }

        // Realiza una solicitud POST al servidor.
        const url = './index.php?controller=SignUpPage&action=SignUp';
        const result = await performAjaxRequest(url, 'POST', formData);

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
            showError(result.message);
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

