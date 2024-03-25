<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>


<?php echo ($userRole == 1) ?
    (' 
<div class="add-user-container">
    <button type="button" class="btn btn-light add-user-btn"
    data-bs-toggle="modal"
    data-bs-target="#createUserModal">
    <span class="add-user-icon"><i class="bi bi-person-add"></i></span>Crear Nuevo
    </button>
</div>

                ')
    :
    '' ?>


<div class="table-container">
    <table class="table table-striped table-dark" id="tablaUsuario">
        <thead>
        <tr class="table-titles">
            <th id="sortID">ID <span class="sort-arrow"></span></th>
            <th id="sortRol">Rol <span class="sort-arrow"></span></th>
            <th id="sortUsername">Nombre de Usuario <span class="sort-arrow"></span></th>
            <th id="sortName">Nombre <span class="sort-arrow"></span></th>
            <th id="sortSurnames">Apellidos <span class="sort-arrow"></span></th>
            <th id="sortMail">Correo <span class="sort-arrow"></span></th>
            <th id="sortPhone">Teléfono <span class="sort-arrow"></span></th>
            <?php echo ($userRole == 1) ?
                (' 
                    <th id="sortStatus">Estado <span class="sort-arrow"></span></th>
                    <th></th>
                ')
                :
                '' ?>

        </tr>
        <tr>
            <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th><select id="searchRole" class="form-select" onchange="filterTable()">
                    <option value="">Todos</option>
                </select>
            </th>
            <th><input type="text" id="searchUsername" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchFirstName" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th>
                <input type="text" id="searchLastName" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchEmail" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th><input type="text" id="searchPhone" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <?php echo ($userRole == 1) ?
                (' 
                <th>
                    <select id="searchStatus" class="form-select" onchange="filterTable()">
                        <option value="">Todos</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                     </select>
                </th>
                <th></th>
                ')
                :
                '' ?>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr id="userRow-<?php echo $user->getIdUsuario(); ?>">

                <td id="userId-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getIdUsuario()); ?></td>
                <td id="userRole-<?php echo $user->getIdUsuario(); ?>">
                    <?php
                    $roleId = $user->getIdRol();
                    echo htmlspecialchars(isset($roles[$roleId]) ? $roles[$roleId] : 'Rol desconocido');
                    ?>
                </td>
                <td id="username-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getUsername()); ?></td>
                <td id="firstName-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getNombre()); ?></td>
                <td id="lastName-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getApellidos()); ?></td>
                <td id="email-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getCorreo()); ?></td>
                <td id="phone-<?php echo $user->getIdUsuario(); ?>"> <?php echo htmlspecialchars($user->getTelefono()); ?></td>
                <?php
                if ($userRole == 1) {
                    echo '<td class="' . ($user->getActivo() ? 'estado-activo' : 'estado-inactivo') . '">
                    <button class="btn btn-toggle"
                            data-state="' . ($user->getActivo() ? 'activo' : 'inactivo') . '"
                            data-user-id="' . $user->getIdUsuario() . '"
                            data-user-name="' . $user->getUsername() . '">
                        ' . ($user->getActivo() ? 'Activo' : 'Inactivo') . '
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-warning edit-user-btn"
                            data-user-id="' . $user->getIdUsuario() . '" data-bs-toggle="modal"
                            data-bs-target="#editUserModal">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                  </td>';
                }
                ?>


            </tr>

        <?php endforeach; ?>

        <tr id="no-result" style="display: none;">
            <td colspan="9">
                <div class="no-result-container">
                    <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados"/>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Modal Crear-->>
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Usuario</h5>
            </div>
            <div class="modal-body">
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="newUserRole" class="form-label">Rol</label>
                        <select class="form-select" id="newUserRole" name="newUserRole">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="newUsername" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="newUsername" name="newUsername">
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="newEmail" name="newEmail">
                    </div>
                    <div class="mb-3">
                        <label for="newFirstName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="newFirstName" name="newFirstName">
                    </div>
                    <div class="mb-3">
                        <label for="newLastName" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="newLastName" name="newLastName">
                    </div>
                    <div class="mb-3">
                        <label for="newPhone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="newPhone" name="newPhone">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Generar contraseña temporal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="newPassword" name="password" readonly>
                            <button class="btn btn-outline-secondary btn-shuffle-pw" type="button"
                                    data-password-field="newPassword" title="Generar contraseña temporal">
                                <i class="bi bi-shuffle"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="createUserData()">
                    Guardar Cambios
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Modificar-->>
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="modal-image-container">
                        <img id="userProfileImage" src="" alt="Imagen de perfil" class="img-thumbnail profile-image">
                    </div>
                    <div class="mb-3">
                        <label for="userId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="userId" name="id" disabled>
                        <!-- El ID no se edita -->
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Rol</label>
                        <select class="form-select" id="userRole" name="role">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="firstName" name="firstName">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="lastName" name="lastName">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Generar contraseña temporal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="password" name="password" readonly>
                            <button class="btn btn-outline-secondary btn-shuffle-pw" type="button"
                                    data-password-field="contrasena" title="Generar contraseña temporal">
                                <i class="bi bi-shuffle"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updateUserData()">
                    Guardar Cambios
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudUsuario/lookUserPage.js"></script>
<script>
    var rolesMap = <?php echo json_encode($roles); ?>;
</script>
</body>
</html>