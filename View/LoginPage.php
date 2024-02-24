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
            background-repeat: no-repeat;
            background-size: cover;
            height: 50em;
            background-color: #000000;
            background-image: url(http://localhost/dashboard/ProyectoSC-502/View/img/Login.png);
        }

    </style>
</head>
<body>

<section id="Nav">
    <div class="Nav">
        <ul class="nav justify-content-end container-fluid">
            <li class="nav-item">
                <a aria-current="page" href="http://localhost/dashboard/ProyectoSC-502/">INICIO</a>
            </li>
            <li class="nav-item">
                <a class="active"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=LoginPage&accion=index">INICIAR
                    SESIÓN</a>
            </li>
            <li class="nav-item">
                <a class="redButton " href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=SignUpPage&accion=index">¡ÚNETE YA!</a>
            </li>
            <li class="nav-item">
                <a href="#">PRECIOS</a>
            </li>
            <li class="nav-item">
                <a href="#">CONTACTOS</a>
            </li>
        </ul>
    </div>
</section>


<section id="Contenido">
    <div class="Contenido container text-center mt-5">
        <div class="row align-items-center">
            <div class="col-6 Logo">
                <img src="http://localhost/dashboard/ProyectoSC-502/View/img/Logo.svg" width=500px height="50%">
            </div>
            <div class="col-6 Login">
                <p class="mt-5 mb-5 Titulo">Iniciar Sesión</p>
                <div class="Opciones">
                    <a class=" mb-5 Google" href="#"><img
                                src="http://localhost/dashboard/ProyectoSC-502/View/img/google.png"> Iniciar Sesión
                        con Google</a>
                    <p class=" mb-5 NoAccount"><a>No Account ?</a>
                        <a style="color: #779341" href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=SignUp&accion=Index">Sign up</a>
                    </p>
                </div>

                <div class="Form">

                    <label for="exampleFormControlInput1" class="form-label">Ingresa tu nombre de usuario o correo electrónico</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Usuario o correo electrónico">
                    <label for="exampleFormControlInput1" class="form-label">Ingresa tu contraseña</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Contraseña">

                    <a class="passwordForgot">Olvide mi contraseña</a>



                </div>
                <a class="btn btn-danger Boton">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</section>

<?php require 'elements\footer.php'; ?>

</body>
</html>