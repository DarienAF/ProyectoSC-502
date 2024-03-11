$(document).ready(function () {
    // Al hacer clic en el botón de registro, se ejecuta esta función.
    $("#signUpBtn").click(async function () {
        // Recoge los valores de los campos del formulario.
        var nombre = $("#Nombre").val();
        var apellidos = $("#Apellidos").val();
        var correo = $("#correoElectronico").val();
        var usuario = $("#nombreUsuario").val();
        var numero = $("#numeroContacto").val();
        var contrasena = $("#Contrasena").val();

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

            // Espera la respuesta del servidor en formato JSON.
            const data = await response.json();

            // Si la respuesta es exitosa, redirige al usuario a la página principal.
            if (data.success) {
                location.href = './index.php?controller=indexPage&action=index';
            } else {
                // Si hay un error, muestra un mensaje.
                alert(data.message);
            }
        } else {
            // Si algún campo está vacío, muestra un mensaje de error.
            alert("Rellene los campos.");
        }
    });
});
