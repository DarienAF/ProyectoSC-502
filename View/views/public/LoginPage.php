<!DOCTYPE html>
<html>
<?php require './View/fragments/head.php'; ?>
<body>
<?php require './View/fragments/nav.php'; ?>

<div class="content">
    <div class="row align-items-center">
        <div class="col Login-container">
            <p class="mt-5 mb-5 Titulo">Iniciar Sesión</p>
            <div class="Opciones">
                <a class=" mb-5 Google" href="#"><img
                            src="./View/img/public/login-signUp/google.png"> Iniciar Sesión
                    con Google</a>
                <p class=" mb-5 NoAccount"><a>No Account ?</a>
                    <a style="color: #779341" href="./index.php?controller=SignUpPage&action=Index">Sign up</a>
                </p>
            </div>
            <form>
                <div class="Form">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Ingresa tu nombre de usuario</label>
                            <input type="text" class="form-control" id="username"
                                   placeholder="Usuario o correo electrónico" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Ingresa tu contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña">
                                <button id="togglePassword" class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <a class="passwordForgot">Olvide mi contraseña</a>
                </div>

                <div class="col-md-12 text-center">
                    <button id="loginBtn" class="btn btn-danger Boton">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para cambio de contraseña -->
<div class="modal" id="passwordChangeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="passwordChangeForm">
                    <div class="form-group">
                        <label for="oldPassword">Contraseña Actual:</label>
                        <input type="password" class="form-control" id="oldPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="newPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="savePasswordBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>


<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudUsuario/login.js"></script>

</body>
</html>