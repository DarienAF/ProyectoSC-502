$(document).ready(function () {
    // Al hacer clic en el botón de registro, se ejecuta esta función.
    $("#signUpBtn").click(async function (event) {
        event.preventDefault();

        // Reiniciar los estilos de los campos para cada intento de envío
        $("#correoElectronico, #nombreUsuario, #Contrasena").css('border', '');

        var nombre = $("#Nombre").val();
        var apellidos = $("#Apellidos").val();
        var correo = $("#correoElectronico").val();
        var usuario = $("#nombreUsuario").val();
        var numero = $("#numeroContacto").val();
        var contrasena = $("#Contrasena").val();


        // Validación del correo electrónico
        var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regexCorreo.test(correo)) {
            alert("Ingrese un correo electrónico válido.");
            $("#correoElectronico").css('border', '1px solid red');
            return;
        }

        // Validación del nombre de usuario
        var regexUsuario = /^[a-zA-Z0-9_-]+$/;
        if (!regexUsuario.test(usuario)) {
            alert("El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.");
            $("#nombreUsuario").css('border', '1px solid red');
            return; // Detiene la ejecución si el nombre de usuario no es válido
        }

        // Validación de la contraseña
        var regexContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (!regexContrasena.test(contrasena)) {
            alert("La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una minúscula y un número.");
            $("#Contrasena").css('border', '1px solid red');
            return; // Detiene la ejecución si la contraseña no es válida
        }

        // Verifica si todos los campos están llenos.
        if (nombre && apellidos && correo && usuario && numero && contrasena) {
            // Realiza una solicitud POST al servidor con los datos del formulario.
            const response = await fetch('./index.php?controller=SignUpPage&action=SignUp', {
                method: "POST",
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    nombre    : nombre   ,
                    apellidos : apellidos,
                    correo    : correo   ,
                    usuario   : usuario  ,
                    numero    : numero   ,
                    contraseña: contrasena
                }),
            });

            const data = await response.json();

            // Si la respuesta es exitosa, redirige al usuario a la página principal.
            if (data.success) {
                location.href = './index.php?controller=indexPage&action=index';
            } else {
                if (data.error == 'correo'){
                    $("#correoElectronico").css('border', '1px solid red');
                }
                if (data.error == 'usuario'){
                    $("#nombreUsuario").css('border', '1px solid red');
                }
                // Si hay un error, muestra un mensaje y no redirige.
                alert(data.message);
            }
        } else {
            // Si algún campo está vacío, muestra un mensaje de error y no redirige.
            alert("Rellene los campos.");
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

