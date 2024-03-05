$(document).ready(function () {

    $("#loginBtn").click(async function () {
        var usuario = $("#nombreUsuario").val();
        var contrasena = $("#Contrasena").val();


        if (contrasena && usuario) {
            const response = await fetch('./index.php?controller=LoginPage&action=LogIn', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    usuario: usuario,
                    contrasena: contrasena
                }),
            });

            const data = await response.json();


            if (data.success) {
                location.href='./index.php?controller=indexPage&action=index'
            } else{
                alert(data.message)
                location.href='./index.php?controller=LoginPage&action=index'
            }

        } else {
            alert("Rellene los campos.")
        }


    })


})