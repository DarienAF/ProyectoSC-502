<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/public/SignUpPageStyle.css">
    <style>
        body {
            background-image: url(./View/img/public/login-signUp/Login.png);
        }
    </style>
</head>
<body>

<?php require './View/fragments/nav.php'; ?>


<section id="Contenido"  class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <img src="./View/img/logos/Logo.svg" width=500px height="50%" style="user-select: none">
            </div>
            <div class="col Login ">
                <p class="mt-5 mb-5 Titulo">Registrarse</p>
                <form class="Form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" placeholder="Nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="Apellidos" placeholder="Apellidos">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="exampleFormControlInput1" class="form-label">Ingresa tu Correo Electrónico</label>
                        <input type="text" class="form-control" id="correoElectronico" placeholder="Correo Electrónico">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre de Usuario">

                        </div>

                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Número de Contacto</label>
                            <input type="text" class="form-control" id="numeroContacto" placeholder="Número de Contacto">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="exampleFormControlInput1" class="form-label">Ingresa tu contraseña</label>
                        <input type="password" class="form-control" id="Contrasena" placeholder="Contraseña">
                            <a class="AlreadyAccount" href="./index.php?controller=LoginPage&action=index">¿Ya tienes una cuenta?</a>
                    </div>

                    <div class="col-md-12 text-center">
                        <button id="signUpBtn" class="btn btn-danger Boton">UNIRME</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudUsuario/signup.js"></script>

</body>
</html>