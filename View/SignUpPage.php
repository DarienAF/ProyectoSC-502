<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/SignUpPageStyle.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            background-size: cover;
            height: 100vh;
            background-color: #000000;
            background-image: url(http://localhost/dashboard/ProyectoSC-502/View/img/Login.png);
        }


    </style>
</head>
<body>

<?php require 'elements\nav.php'; ?>


<section id="Contenido">
    <div class="Contenido container text-center mt-5">
        <div class="row align-items-center">
            <div class="col-md-6 Logo">
                <img src="http://localhost/dashboard/ProyectoSC-502/View/img/Logo.svg" width=500px height="50%">
            </div>
            <div class="col-md-6 Login mb-4">
                <p class="mt-5 mb-5 Titulo">Registrarse</p>
                <form class="Form">
                    <label for="exampleFormControlInput1" class="form-label">Ingresa tu Correo Electrónico</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Correo Electrónico">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de Usuario">

                        </div>

                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Número de Contacto</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Número de Contacto">

                        </div>
                    </div>
                    <label for="exampleFormControlInput1" class="form-label">Ingresa tu contraseña</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Contraseña">

                    <a class="AlreadyAccount" href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=Login&action=index">¿Ya tienes una cuenta?
                        <br>Inicia Sesión</a>



                </form>
                <a class="btn btn-danger Boton">UNIRME</a>
            </div>
        </div>
    </div>
</section>

<?php require 'elements\footer.php'; ?>
</body>
</html>