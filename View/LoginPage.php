<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/LoginPageStyle.css">
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


<section id="Contenido"  class="d-flex justify-content-center align-items-center">>
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <img src="./View/img/Logo.svg" width=500px height="50%" style="user-select: none">
            </div>
            <div class="col Login ">
                <p class="mt-5 mb-5 Titulo">Iniciar Sesión</p>
                <div class="Opciones">
                    <a class=" mb-5 Google" href="#"><img
                                src="./View/img/google.png"> Iniciar Sesión
                        con Google</a>
                    <p class=" mb-5 NoAccount"><a>No Account ?</a>
                        <a style="color: #779341" href="./index.php?controller=SignUp&action=Index">Sign up</a>
                    </p>
                </div>

                <form>
                    <div class="Form">

                        <label  class="form-label">Ingresa tu nombre de usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" placeholder="Usuario o correo electrónico" required>
                        <label  class="form-label">Ingresa tu contraseña</label>
                        <input type="password" class="form-control" id="Contrasena" placeholder="Contraseña" required>

                        <a class="passwordForgot">Olvide mi contraseña</a>

                    </div>
                    <button id="loginBtn" class="btn btn-danger Boton">Iniciar Sesión</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?php require 'elements\footer.php'; ?>

<script src="./View/js/login.js"></script>

</body>
</html>