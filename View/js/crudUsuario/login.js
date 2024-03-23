$(document).ready(function () {
    // Al hacer clic en el botón de inicio de sesión, se ejecuta esta función
    $("#loginBtn").click(async function () {
        event.preventDefault();

        // Recoge los valores de los campos de usuario y contraseña
        var usuario = $("#nombreUsuario").val();
        var contrasena = $("#Contrasena").val();

        // Limpiar border rojos (si existen)
        $("#nombreUsuario, #Contrasena").css('border', '');

        // Buscar campos en blanco y marcar borde de rojo
        var isFormValid = true;
        $("#nombreUsuario, #Contrasena").each(function () {
            if (!$(this).val()) {
                $(this).css('border', '1px solid red');
                isFormValid = false;
            }
        });
        if (!isFormValid) {
            Swal.fire({
                title: "Todos los campos deben ser completados.",
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Realiza una solicitud POST al servidor con los datos del usuario
        const response = await fetch('./index.php?controller=LoginPage&action=LogIn', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({usuario: usuario, contrasena: contrasena}),
        });

        // Espera la respuesta del servidor en formato JSON
        const data = await response.json();


        // Si la respuesta es exitosa, redirige al usuario a la página principal
        if (data.success) {
            location.href = './index.php?controller=indexPage&action=index'
        } else {
            if (data.error == 'usuario' || data.error == 'ambos') {
                $("#nombreUsuario").css('border', '1px solid red');
            }
            if (data.error == 'contraseña' || data.error == 'ambos') {
                $("#Contrasena").css('border', '1px solid red');
            }
            // Si hay un error, muestra un mensaje y no redirige
            Swal.fire({
                title: "¡Hubo un error!",
                text: data.message,
                icon: "error",
                confirmButtonColor: 'rgb(29, 29, 29)',
                confirmButtonText: 'Aceptar'
            });
        }
    })
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