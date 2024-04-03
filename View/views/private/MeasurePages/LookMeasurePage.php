<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>
<body>
<?php require './View/fragments/nav_private.php'; ?>

<h1 class="welcomeMessage">Medidas</h1>

<div class="add-measure-container">
    <button type="button" class="btn btn-light add-measure-btn"
            data-bs-toggle="modal"
            data-bs-target="#createMeasureModal">
        <span class="add-measure-icon"><i class="bi bi-plus-circle"></i></span>Agregar registro
    </button>
</div>


<div class="table-container">
    <table class="table table-striped table-dark" id="tablaMedida">
        <thead>
        <tr class="table-titles">
            <th id="sortID">ID Medida <span class="sort-arrow"></span></th>
            <th id="sortUserID"> ID Usuario <span class="sort-arrow"></span></th>
            <th id="sortUsername"> Usuario <span class="sort-arrow"></span></th>
            <th id="sortRegisterDate">Fecha Registro <span class="sort-arrow"></span></th>
            <th id="sortWeight">Peso <span class="sort-arrow"></span></th>
            <th id="sortHeight">Altura <span class="sort-arrow"></span></th>
            <th id="sortAge">Edad <span class="sort-arrow"></span></th>
            <th id="sortFat">Grasa <span class="sort-arrow"></span></th>
            <th id="sortMuscle">Musculo <span class="sort-arrow"></span></th>
            <th></th>

        </tr>
        <tr>
            <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchUserId" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchUsername" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="date" id="searchRegisterDate" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchWeight" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="number" id="searchHeight" placeholder="Buscar" oninput="filterTable()"
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
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userMeasures as $measure): ?>
            <tr id="measureRow-<?php echo $measure['id_medida']; ?>">
                <td id="id-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['id_medida']); ?></td>
                <td id="userId-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['id_Usuario']); ?></td>
                <td id="username-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['usuario']); ?></td>
                <td id="fecha-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['fecha']); ?></td>
                <td id="peso-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['peso']); ?></td>
                <td id="altura-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['altura']); ?></td>
                <td id="edad-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['edad']); ?></td>
                <td id="grasa-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['grasa']); ?></td>
                <td id="musculo-<?php echo $measure['id_medida']; ?>"><?php echo htmlspecialchars($measure['musculo']); ?></td>
                <td>
                    <button type="button" class="btn btn-warning edit-user-btn"
                            measure-id="<?php echo htmlspecialchars($measure['id_medida']); ?>" data-bs-toggle="modal"
                            data-bs-target="#editMeasureModal">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr id="no-result" style="display: none;">
            <td colspan="10">
                <div class="no-result-container">
                    <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados"/>
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
                        <label for="newMeasureUserID" class="form-label">Usuario</label>
                        <select class="form-control" id="newMeasureUserID" name="newMeasureUserID">

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
                <button type="button" class="btn btn-success" id="createMeasureBTN">
                    Guardar Cambios
                </button>
                <button type="button" class="btn btn-danger" id='closeMeasureModal' data-bs-dismiss="modal">Cerrar
                </button>
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
                        <input type="text" class="form-control" id="measureId" name="measureId" disabled>
                        <!-- El ID no se edita -->
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <select class="form-control" id="measureUserID" name="measureUserID">

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
                <button type="button" class="btn btn-success" id="updateMeasureDataBtn">
                    Guardar Cambios
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>

<script src="./View/js/crudMedidas/lookMeasurePage.js"></script>

</body>
</html>