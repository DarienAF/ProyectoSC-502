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
                            <img id="userProfileImage" src=<?php echo $userImagePath ?> alt="Imagen de perfil"
                            class="img-thumbnail">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="imagen" class="form-label">Imagen de Perfil:</label>
                            <input type="file" class="form-control" id="imagen">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="ID" class="form-label">ID</label>
                            <input type="text" class="form-control" id="ID:" value=<?php echo $user_id ?> disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="username"
                                   value=<?php echo $username ?> disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="role" class="form-label">Rol:</label>
                            <input type="text" class="form-control" id="role" value=<?php echo $userRole ?> disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" value=<?php echo $userFirstName ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" value=<?php echo $userLastName ?>>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo" value=<?php echo $userEmail ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" value=<?php echo $userPhone ?>>
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
                        <button class="btn btn-primary" id="saveBtn" style="display: none;">Guardar</button>
                        <button class="btn btn-primary" id="cancelBtn" style="display: none;">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudUsuario/profilePage.js"></script>

<script>

    var editarBtn = document.getElementById("editBtn");
    var guardarBtn = document.getElementById("saveBtn");
    var cancelarBtn = document.getElementById("cancelBtn");
    editarBtn.addEventListener("click", function () {
        guardarBtn.style.display = "inline-block";
        cancelarBtn.style.display = "inline-block";
        editarBtn.style.display = "none";
    });

    cancelarBtn.addEventListener("click", function () {
        guardarBtn.style.display = "none";
        cancelarBtn.style.display = "none";
        editarBtn.style.display = "inline-block";
    });


</script>

</body>

</html>