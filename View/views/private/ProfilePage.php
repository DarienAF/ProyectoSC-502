<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

<div class="content">
    <div class="container profile-info">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Perfil de Miembro</h1>
                <div class="profile-info">
                    <div class="row mb-3 text-center">
                        <div class="col-md-12">
                            <img id="userProfileImage" class="img-thumbnail profile-image"
                                 alt="Imagen de perfil" src=<?php echo $userImagePath ?>>
                        </div>
                    </div>
                    <div id="profileImage-container" class="row mb-3">
                        <div class="col-md-12">
                            <label for="imagen" class="form-label">Imagen de Perfil:</label>
                            <input type="file" class="form-control" id="profileImage" name="profileImage"
                                   accept="image/jpeg, image/jpg, image/webp, image/png, image/gif">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="userId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="userId" readonly value=<?php echo $user_id ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="username" readonly
                                   value=<?php echo $username ?>>
                        </div>
                        <div class="col-md-3">
                            <label for="role" class="form-label">Rol:</label>
                            <input type="text" class="form-control" id="role" readonly value=<?php echo $userRole ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="firstName" readonly
                                   value=<?php echo $userFirstName ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="lastName" readonly
                                   value=<?php echo $userLastName ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" readonly value=<?php echo $userEmail ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="phone" readonly value=<?php echo $userPhone ?>>
                        </div>
                    </div>
                    <div class="row mb-3 text-center">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="changePwBtn">Cambiar Contraseña</button>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" id="editBtn">Editar Perfil</button>
                        <!-- SOLO SE MUESTRAN DESPUÉS DE DARLE CLICK A EDITAR PERFIL -->
                        <button class="btn btn-primary" id="saveBtn" onclick="updateUserData()" style="display: none;">
                            Guardar
                        </button>
                        <button class="btn btn-primary" id="cancelBtn" style="display: none;">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>

<!-- Modal para cambio de contraseña -->
<div class="modal" id="passwordChangeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Contraseña</h5>
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
                <button type="button" class="btn btn-secondary" id="closeModalBtn">Cancelar</button>
                <button type="button" class="btn btn-primary" id="savePasswordBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="./View/js/crudUsuario/profilePage.js"></script>

</body>

</html>