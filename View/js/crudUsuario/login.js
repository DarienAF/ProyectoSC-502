$(document).ready(function () {
    // Al hacer clic en el botón de inicio de sesión, se ejecuta esta función.
    $("#loginBtn").click(async function () {
        // Recoge los valores de los campos de usuario y contraseña.
        var usuario = $("#nombreUsuario").val();
        var contrasena = $("#Contrasena").val();

        // Verifica si ambos campos están llenos.
        if (contrasena && usuario) {
            // Realiza una solicitud POST al servidor con los datos del usuario.
            const response = await fetch('./index.php?controller=LoginPage&action=LogIn', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({usuario: usuario, contrasena: contrasena}),
            });

            // Espera la respuesta del servidor en formato JSON.
            const data = await response.json();

            // Si la respuesta es exitosa, redirige al usuario a la página principal.
            if (data.success) {
                location.href='./index.php?controller=indexPage&action=index'
            } else {
                // Si hay un error, muestra un mensaje y redirige a la página de inicio de sesión.
                alert(data.message)
                location.href='./index.php?controller=LoginPage&action=index'
            }
        } else {
            // Si los campos no están llenos, muestra un mensaje de error.
            alert("Rellene los campos.")
        }
    })
});
