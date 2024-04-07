<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <h1 class="welcomeMessage">Planes de Entrenamiento</h1>

    <div class="add-training-container">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-light add-training-btn" data-bs-toggle="modal"
                    data-bs-target="#createPlanModal">
                    <span class="add-training-icon"><i class="bi bi-database-add"></i></span>Planes
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-light add-routine-btn" data-bs-toggle="modal"
                    data-bs-target="#createPlanExerciseModal">
                    <span class="add-routine-icon"><i class="bi bi-node-plus"></i></span>Rutinas
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Crear Plan -->
    <div class="modal fade" id="createPlanModal" tabindex="-1" aria-labelledby="createPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nuevo Plan</h5>
                </div>
                <div class="modal-body">
                    <form id="createPlanForm">
                        <div class="mb-3">
                            <label for="newPlanName" class="form-label">Nombre del Plan</label>
                            <input type="text" class="form-control" id="newPlanName" name="newPlanName">
                        </div>
                        <div class="mb-3">
                            <label for="newPlanDay" class="form-label">Día</label>
                            <select class="form-select" id="newPlanDay" name="newPlanDay">
                                <option value="" disabled selected>Seleccionar día...</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sebado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="newUsername" class="form-label">Usuario Asignado</label>
                            <select class="form-select" id="newUserClass" name="newUserClass">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="createPlanData()">
                        Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear PlanEjercicio -->
    <div class="modal fade" id="createPlanExerciseModal" tabindex="-1" aria-labelledby="createPlanExerciseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nuevo Plan Ejercicio</h5>
                </div>
                <div class="modal-body">
                    <form id="createPlanExerciseForm">
                        <div class="mb-3">
                            <label for="newPlanName" class="form-label">Nombre del Plan</label>
                            <select class="form-select" id="newPlanName" name="newPlanName" onchange="updateUsername()">
                                <!-- opciones para cada plan -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario Asignado</label>
                            <input type="text" class="form-control" id="username" name="username" readonly>
                            <!-- function updateUsername() {
                                // Realizar una llamada AJAX al servidor para obtener el username basado en el planId
                                // Actualiza el valor del campo 'username' con el resultado
                            } -->
                        </div>
                        <div class="mb-3">
                            <label for="newExerciseName" class="form-label">Nombre del Ejercicio</label>
                            <select class="form-select" id="newExerciseName" name="newExerciseName">
                                <!-- opciones para cada ejercicio -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="newSeries" class="form-label">Series</label>
                            <input type="number" class="form-control" id="newSeries" name="newSeries">
                        </div>
                        <div class="mb-3">
                            <label for="newRepetitions" class="form-label">Repeticiones</label>
                            <input type="number" class="form-control" id="newRepetitions" name="newRepetitions">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="createPlanExerciseData()">
                        Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped table-dark" id="tablaPlan">
            <thead>
                <tr class="table-titles">
                    <th id="sortID">ID Plan <span class="sort-arrow"></span></th>
                    <th id="sortPlanName">Nombre del Plan <span class="sort-arrow"></span></th>
                    <th id="sortDay">Día <span class="sort-arrow"></span></th>
                    <th id="sortUsername">Usuario Asignado <span class="sort-arrow"></span></th>
                    <th id="sortExerciseName">Ejercicio <span class="sort-arrow"></span></th>
                    <th id="sortSeries">Series <span class="sort-arrow"></span></th>
                    <th id="sortRepetitions">Repeticiones <span class="sort-arrow"></span></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th><input type="number" id="searchPlanId" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchPlanName" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchDay" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchUsername" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="text" id="searchExerciseName" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="number" id="searchSeries" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th><input type="number" id="searchRepetitions" placeholder="Buscar" oninput="filterTable()"
                            class="form-control">
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planExercises as $planExercise): ?>
                <tr id="planExerciseRow-<?php echo $planExercise['id_plan']; ?>">
                    <td id="planId-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['id_plan']); ?></td>
                    <td id="planName-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['nombre_plan']); ?></td>
                    <td id="day-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['dia']); ?></td>
                    <td id="username-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['username']); ?></td>
                    <td id="exerciseName-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['nombre_ejercicio']); ?></td>
                    <td id="series-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['series']); ?></td>
                    <td id="repetitions-<?php echo $planExercise['id_plan']; ?>">
                        <?php echo htmlspecialchars($planExercise['repeticiones']); ?></td>
                    <td>
                        <button type="button" class="btn btn-warning edit-plan-btn"
                            plan-id="<?php echo htmlspecialchars($planExercise['id_plan']); ?>" data-bs-toggle="modal"
                            data-bs-target="#editPlanModal">
                            <i class="bi bi-database-exclamation"></i>
                        </button>
                    </td>
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


    <?php require './View/fragments/footer.php'; ?>

</body>

</html>