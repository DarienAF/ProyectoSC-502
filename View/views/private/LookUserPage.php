<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./View/style/private/LookUserPageStyle.css">
</head>

<body>
    <?php require './View/fragments/nav_private.php'; ?>
    <!-- Filtros -->
    <div class="filter-container my-3 p-3">
        <div class="row justify-content-center">
            <div class="col-md-auto d-flex align-items-center">
                <input type="number" id="searchId" placeholder="ID" oninput="filterTable()" class="form-control">
            </div>

            <div class="col-md-auto d-flex align-items-center">
                <label for="searchRole" class="form-label me-2">Rol</label>
                <select id="searchRole" class="form-select" onchange="filterTable()">
                    <option value="">Todos</option>
                </select>
            </div>
            <div class="col-md-auto d-flex align-items-center">
                <input type="text" id="searchUsername" placeholder="Nombre de usuario" oninput="filterTable()"
                       class="form-control">

            </div>
            <div class="col-md-auto d-flex align-items-center">
                <input type="text" id="searchFirstName" placeholder="Nombre" oninput="filterTable()"
                       class="form-control">

            </div>
            <div class="col-md-auto d-flex align-items-center">
                <input type="text" id="searchLastName" placeholder="Apellidos" oninput="filterTable()"
                       class="form-control">

            </div>
            <div class="col-md-auto d-flex align-items-center">
                <input type="text" id="searchEmail" placeholder="Correo" oninput="filterTable()" class="form-control">
            </div>
            <div class="col-md-auto d-flex align-items-center">
                <input type="text" id="searchPhone" placeholder="Teléfono" oninput="filterTable()" class="form-control">
            </div>
            <div class="col-md-auto d-flex align-items-center">
                <label for="searchStatus" class="form-label me-2">Estado</label>
                <select id="searchStatus" class="form-select" onchange="filterTable()">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped table-dark" id="tablaUsuario">
            <thead>
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre de Usuario</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Estado</th>
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
                    <td class="<?php echo $user->getActivo() ? 'estado-activo' : 'estado-inactivo'; ?>">
                        <button class="btn btn-toggle"
                                data-state="<?php echo $user->getActivo() ? 'activo' : 'inactivo'; ?>"
                                data-user-id="<?php echo $user->getIdUsuario(); ?>"
                                data-user-name="<?php echo $user->getUsername(); ?>">
                            <?php echo $user->getActivo() ? 'Activo' : 'Inactivo'; ?>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning edit-btn"
                                data-user-id="<?php echo $user->getIdUsuario(); ?>" data-bs-toggle="modal"
                                data-bs-target="#editUserModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <script src="./View/js/crudUsuario/lookUser.js"></script>

    <!-- Modal-->>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="image-container">
                            <img id="userProfileImage" src="" alt="Imagen de perfil" class="img-thumbnail mb-3"
                                 style="width: 100px; height: 100px;">
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
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" name="firstName">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="saveUserData()" data-bs-dismiss="modal">
                        Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php require './View/fragments/footer.php'; ?>

    <script>
        var rolesMap = <?php echo json_encode($roles); ?>;
    </script>
</body>
</html>