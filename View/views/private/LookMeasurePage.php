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
            <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th><select id="searchUsername" class="form-select" onchange="filterTable()">
                    <option value="">Todos</option>
                </select>
            </th>
            <th>
                <input type="date" id="searchRegisterDate" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th>
                <input type="number" id="searchWeight" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th>
                <input type="number" id="searchHeight" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th>
                <input type="number" id="searchAge" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th>
                <input type="number" id="searchFat" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>
            <th>
                <input type="number" id="searchMuscule" placeholder="Buscar" oninput="filterTable()" class="form-control">
            </th>

        </tr>
        </thead>
        
       
    </table>
</div>

<!-- Modal Crear-->>
<div class="modal fade" id="createMeasureModal" tabindex="-1" aria-labelledby="createMeasureModalLabel" aria-hidden="true">
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
                        <input type="number" step="0.01"  class="form-control" id="newHeight" name="newHeight">
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
                <button type="button" class="btn btn-success" onclick="createUserData()">
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