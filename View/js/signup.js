$(document).ready(function (){
    $("#signUpBtn").click(async function(){


        var nombre = $("#Nombre").val()
        var apellidos = $("#Apellidos").val()
        var correo = $("#correoElectronico").val()
        var usuario = $("#nombreUsuario").val()
        var numero = $("#numeroContacto").val()
        var contrasena = $("#Contrasena").val()

        if(nombre && apellidos && correo && usuario && numero && contrasena){
            const response = await fetch('./index.php?controller=SignUpPage&action=SignUp',{
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombre    : nombre   ,
                    apellidos : apellidos,
                    correo    : correo   ,
                    usuario   : usuario  ,
                    numero    : numero   ,
                    contraseña: contrasena
                }),
            });

            const data = await response.json()

            if(data.success){
                alert(data.message)
                location.href='./index.php?controller=IndexPage&action=Index'
            }else
                alert(data.message)

        } else{
            alert("Rellene los campos.")
        }

    })

})