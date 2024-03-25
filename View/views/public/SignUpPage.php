<!DOCTYPE html>
<html>
<?php require './View/fragments/head.php'; ?>
<body>
<?php require './View/fragments/nav.php'; ?>

<div class="content">
    <div class="row align-items-center">
        <div class="col SignUp-container ">
            <p class="mt-5 mb-5 Titulo">Registrarse</p>
            <form class="Form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Apellidos">
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">Ingresa tu Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Correo Electrónico">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" placeholder="Nombre de Usuario">

                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Número de Contacto</label>
                        <input type="number" class="form-control" id="phone" placeholder="Número de Contacto">

                    </div>
                </div>

                <div class="col-md-12">
                    <label for="password" class="form-label">Ingresa tu contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Contraseña">
                        <button id="togglePassword" class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <a class="AlreadyAccount" href="./index.php?controller=LoginPage&action=index">¿Ya tienes una
                        cuenta?</a>
                </div>

                <div class="col-md-12 text-center">
                    <button id="signUpBtn" class="btn btn-danger Boton">UNIRME</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudUsuario/signup.js"></script>

</body>
</html>