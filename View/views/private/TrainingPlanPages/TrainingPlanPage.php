<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
<?php require './View/fragments/nav_private.php'; ?>

<h1 class="welcomeMessage">Planes de Entrenamiento</h1>

<div class="add-plan-container">
    <button type="button" class="btn btn-light add-user-btn" data-bs-toggle="modal"
            data-bs-target="#crearEjercicioModal">
        <span class="add-user-icon"><i class="bi bi-patch-plus"></i></span>Crear Plan
    </button>
</div>


<div class="table-container">
    <table class="table table-striped table-dark" id="tablaPlanes">
        <thead>
        <tr class="table-titles">
            <th id="sortID">ID <span class="sort-arrow"></span></th>
            <th id="sortNombre">Nombre <span class="sort-arrow"></span></th>
            <th id="sortUsuario">Usuario <span class="sort-arrow"></span></th>
            <th id="sortPlanEjercicio">Plan Ejercicio <span class="sort-arrow"></span></th>
            <th id="sortDia">Dia <span class="sort-arrow"></span></th>
            <th></th>
        </tr>
        <tr>
            <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchNombre" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchUsuario" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th>
                <input type="text" id="searchPlanEjercicio" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th><input type="text" id="searchDia" placeholder="Buscar" oninput="filterTable()"
                       class="form-control">
            </th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($plans as $plan): ?>
            <tr id="planRow-<?php echo $plan->getIdPlan(); ?>">
                <td id="planId-<?php echo $plan->getIdPlan(); ?>">
                    <?php echo htmlspecialchars($plan->getIdPlan()); ?>
                </td>
                <td id="planName-<?php echo $plan->getIdPlan(); ?>">
                    <?php echo htmlspecialchars($plan->getNombrePlan()); ?>
                </td>
                <td id="planIdUsuario-<?php echo $plan->getIdPlan(); ?>">
                    <?php echo htmlspecialchars($plan->getIdUsuarioName()); ?>
                </td>
                <td id="planIdPlanEjercicio-<?php echo $plan->getIdPlan(); ?>">
                    <?php echo htmlspecialchars($plan->getIdPlanEjercicioName()); ?>
                </td>
                <td id="planDia-<?php echo $plan->getIdPlan(); ?>">
                    <?php echo htmlspecialchars($plan->getDia()); ?>
                </td>
                <td>
                    <button type="button" class="btn btn-danger delete-plan-btn"
                            data-plan-id="<?php echo $plan->getIdPlan(); ?>">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
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

<!-- Modal crear plan ejercicio -->
<div class="modal fade" id="crearEjercicioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crear Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select class="form-select mb-3" id="userSelect" aria-label="Seleccionar usuario">
                </select>
                <select class="form-select mb-3" id="exerciseSelect" aria-label="Seleccionar ejercicio">
                </select>

                <div id="exerciseImageContainer" class="mb-3">
                    <img id="exerciseImage" src="" alt="Imagen del ejercicio" class="img-fluid">
                </div>

                <div class="row">
                    <div class="col">
                        <input type="number" id="series" placeholder="Series" class="form-control">
                    </div>
                    <div class="col">
                        <input type="number" id="repetitions" placeholder="Repeticiones" class="form-control">
                    </div>
                    <div class="col">
                        <select class="form-select" id="daySelect" aria-label="Seleccionar día">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sábado">Sábado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" id="saveExercisePlan" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>
<script src="./View/js/crudPlanes/trainingplanpage.js"></script>
</body>

</html>