<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

    <?php echo ($userRole == 1 || $userRole == 3) ?
    (' 
<div class="add-measure-container">
    <button type="button" class="btn btn-light add-measure-btn"
    data-bs-toggle="modal"
    data-bs-target="#createMeasureModal">
    <span class="add-measure-icon"><i class="bi bi-plus-circle"></i></span>Agregar registro
    </button>
</div>
                ')
    :
    '' ?>


    <div class="table-container">
        <table class="table table-striped table-dark" id="tablaMedida">
            <thead>
                <tr class="table-titles">
                    <th id="sortID">ID Medida <span class="sort-arrow"></span></th>
                    <!-- Es el id Usuario, pero creo que se puede llamar el usuario para un mejor lectura-->
                    <th id="sortUsername">Username <span class="sort-arrow"></span></th>
                    <th id="sortRegisterDate">Fecha Registro <span class="sort-arrow"></span></th>
                    <th id="sortWeight">Peso <span class="sort-arrow"></span></th>
                    <th id="sortHeight">Altura <span class="sort-arrow"></span></th>
                    <th id="sortAge">Edad <span class="sort-arrow"></span></th>
                    <th id="sortFat">Grasa <span class="sort-arrow"></span></th>
                    <th id="sortMuscle">Musculo <span class="sort-arrow"></span></th>

                </tr>
                <tr>
                    <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><select id="searchUsername" class="form-select" onchange="filterTable()">
                            <option value="">Todos</option>
                        </select>
                    </th>
                    <th><input type="date" id="searchRegisterDate" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th> <input type="number" id="searchWeight" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th> <input type="number" id="searchHeight" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="number" id="searchAge" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="number" id="searchFat" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="number" id="searchMuscule" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($measures as $measure): ?>
                <tr id="measureRow-<?php echo $measure->getIdMedida(); ?>">

                    <td id="measureId-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getIdMedida()); ?></td>
                    <td id="username-<?php echo $measure->getIdMedida(); ?>">
                        <?php
            // Asumiendo una función para obtener el nombre de usuario a partir del ID de usuario
          //  $userId = getUsername($measure->getIdUsuario());
            echo htmlspecialchars(isset($userId) ? $userId : 'Usuario desconocido');
            ?>
                    </td>
                    <td id="registerDate-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getFechaRegistro()); ?></td>
                    <td id="weight-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getPeso()); ?></td>
                    <td id="height-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getAltura()); ?></td>
                    <td id="age-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getEdad()); ?></td>
                    <td id="fat-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getGrasa()); ?></td>
                    <td id="muscle-<?php echo $measure->getIdMedida(); ?>">
                        <?php echo htmlspecialchars($measure->getMusculo()); ?></td>
                    <?php
              /*  if ($userRole == 1 || $userRole == 3) {
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
                }*/
                ?>

                </tr>
                <?php endforeach; ?>

                <tr id="no-result" style="display: none;">
                    <td colspan="8">
                        <div class="no-result-container">
                            <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados" />
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <!-- Modal Crear-->>
    <div class="modal fade" id="createMeasureModal" tabindex="-1" aria-labelledby="createMeasureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nueva Medida</h5>
                </div>
                <div class="modal-body">
                    <form id="createMeasureForm">
                        <div class="mb-3">
                            <label for="newMeasureUser" class="form-label">Usuario</label>
                            <select class="form-select" id="newMeasureUser" name="newMeasureUser">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="newWeight" class="form-label">Peso Corporal</label>
                            <input type="number" step="0.01" class="form-control" id="newWeight" name="newWeight">
                        </div>
                        <div class="mb-3">
                            <label for="newHeight" class="form-label">Altura</label>
                            <input type="number" step="0.01" class="form-control" id="newHeight" name="newHeight">
                        </div>
                        <div class="mb-3">
                            <label for="newAge" class="form-label">Edad Actual</label>
                            <input type="number" class="form-control" id="newAge" name="newAge">
                        </div>
                        <div class="mb-3">
                            <label for="newFat" class="form-label">Grasa Corporal</label>
                            <input type="number" step="0.1" class="form-control" id="newFat" name="newFat">
                        </div>
                        <div class="mb-3">
                            <label for="newMuscle" class="form-label">Musculo</label>
                            <input type="number" step="0.1" class="form-control" id="newMuscle" name="newMuscle">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="createMeasureData()">
                        Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modificar-->
    <div class="modal fade" id="editMeasureModal" tabindex="-1" aria-labelledby="editMeasureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Medida</h5>
                </div>
                <div class="modal-body">
                    <form id="editMeasureForm">
                        <div class="mb-3">
                            <label for="measureId" class="form-label">ID Medida</label>
                            <input type="text" class="form-control" id="measureId" name="id" disabled>
                            <!-- El ID no se edita -->
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <select class="form-select" id="username" name="username">
                        </select>
                        </div>
                    <!-- No se si la Base de datos permita esto, solo se que al crealo, hace la fecha
                        Desconozco si al modificarlo tambien
                        <div class="mb-3">
                            <label for="registerDate" class="form-label">Fecha Registro</label>
                            <input type="date" class="form-control" id="registerDate" name="registerDate" readonly>
                        </div> -->
                        <div class="mb-3">
                            <label for="weight" class="form-label">Peso</label>
                            <input type="number" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Altura</label>
                            <input type="number" class="form-control" id="height" name="height">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="mb-3">
                            <label for="fat" class="form-label">Grasa</label>
                            <input type="number" class="form-control" id="fat" name="fat">
                        </div>
                        <div class="mb-3">
                            <label for="muscle" class="form-label">Musculo</label>
                            <input type="number" class="form-control" id="muscle" name="muscle">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateMeasureData()">
                        Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <?php require './View/fragments/footer.php'; ?>

    <script src="./View/js/crudMedida/lookMeasurePage.js"></script>
    <script>
    var rolesMap = <?php echo json_encode($roles); ?>;
    </script>
</body>

</html>