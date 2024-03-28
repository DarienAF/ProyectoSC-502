<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <?php echo ($userRole == 1 || $userRole == 3) ?
    (' 
<div class="add-asignature-container">
    <button type="button" class="btn btn-light add-asignature-btn"
    data-bs-toggle="modal"
    data-bs-target="#createAsignatureModal">
    <span class="add-asignature-icon"><i class="bi bi-file-plus"></i></span>Crear Nueva
    </button>
</div>


                ')
    :
    '' ?>
    <!-- Tabla de Clases-->
    <div class="table-container">
        <table class="table table-striped table-dark" id="tablaClase">
            <thead>
                <tr class="table-titles">
                    <th id="sortID">ID Clase <span class="sort-arrow"></span></th>
                    <!-- Es el id Usuario, pero creo que se puede llamar el usuario para un mejor lectura-->
                    <th id="sortUsername">Nombre de Usuario <span class="sort-arrow"></span></th>
                    <th id="sortStartTime">Hora Inicio <span class="sort-arrow"></span></th>
                    <th id="sortEndTime">Hora Fin <span class="sort-arrow"></span></th>
                    <th id="sortDay">Día <span class="sort-arrow"></span></th>
                    <th id="sortClassName">Nombre Clase <span class="sort-arrow"></span></th>
                </tr>
                <tr>
                    <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><select id="searchUsername" class="form-select" onchange="filterTable()">
                            <option value="">Todos</option>
                        </select>
                    </th>
                    <th><input type="time" id="searchStartTime" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="time" id="searchEndTime" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchDay" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchClassName" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                </tr>
            </thead>


        </table>
    </div>

    <!-- Modal Crear-->
<div class="modal fade" id="createAsignatureModal" tabindex="-1" aria-labelledby="createAsignatureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Realizar Nueva Clase</h5>
            </div>
            <div class="modal-body">
                <form id="createClassForm">
                    <div class="mb-3">
                        <label for="newUsername" class="form-label">Nombre de Entrenador</label>
                        <select class="form-select" id="newUserClass" name="newUserClass">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="newStartTime" class="form-label">Hora Inicio</label>
                        <input type="time" class="form-control" id="newStartTime" name="newStartTime">
                    </div>
                    <div class="mb-3">
                        <label for="newEndTime" class="form-label">Hora Fin</label>
                        <input type="time" class="form-control" id="newEndTime" name="newEndTime">
                    </div>
                    <div class="mb-3">
                        <label for="newDay" class="form-label">Día</label>
                        <input type="text" class="form-control" id="newDay" name="newDay">
                    </div>
                    <div class="mb-3">
                        <label for="newClassName" class="form-label">Nombre Clase</label>
                        <input type="text" class="form-control" id="newClassName" name="newClassName">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="createClassData()">
                    Guardar Cambios
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


    <?php require './View/fragments/footer.php'; ?>

</body>

</html>