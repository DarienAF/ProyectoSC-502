<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

        <h1 class="welcomeMessage">Clases</h1>

        <!-- Vista de Clases Administradores y Entrenadores -->
        <?php if ($userRole == 1 || $userRole == 3): ?>
        <div class="add-asignature-container">
            <button type="button" class="btn btn-light add-asignature-btn" data-bs-toggle="modal"
                data-bs-target="#createAsignatureModal">
                <span class="add-asignature-icon"><i class="bi bi-file-plus"></i></span>Crear Nueva
            </button>
        </div>

        <div class="table-container">
            <table class="table table-striped table-dark" id="tablaClase">
                <thead>
                    <tr class="table-titles">
                        <th id="sortID">ID Clase <span class="sort-arrow"></span></th>
                        <th id="sortUsername">Nombre de Usuario <span class="sort-arrow"></span></th>
                        <th id="sortStartTime">Hora Inicio <span class="sort-arrow"></span></th>
                        <th id="sortEndTime">Hora Fin <span class="sort-arrow"></span></th>
                        <th id="sortDay">Día <span class="sort-arrow"></span></th>
                        <th id="sortClassName">Nombre Clase <span class="sort-arrow"></span></th>
                        <th id="sortCategoryName">Categoria <span class="sort-arrow"></span></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="text" id="searchUsername" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="time" id="searchStartTime" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="time" id="searchEndTime" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="text" id="searchDay" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="text" id="searchClassName" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th><input type="text" id="searchCategoryName" placeholder="Buscar" oninput="filterTable()"
                                class="form-control"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userClasses as $class): ?>
                    <tr id="classRow-<?php echo $class['id_clase']; ?>">
                        <td id="idClase-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['id_clase']); ?></td>
                        <td id="nombreUsuario-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['usuario']); ?></td>
                        <td id="horaInicio-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['hora_inicio']); ?></td>
                        <td id="horaFin-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['hora_fin']); ?></td>
                        <td id="dia-<?php echo $class['id_clase']; ?>"><?php echo htmlspecialchars($class['dia']); ?>
                        </td>
                        <td id="nombreClase-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['nombre']); ?></td>
                        <td id="categoria-<?php echo $class['id_clase']; ?>">
                            <?php echo htmlspecialchars($class['categoria']); ?></td>
                        <td>
                            <button type="button" class="btn btn-warning edit-clase-btn"
                                clase-id="<?php echo htmlspecialchars($class['id_clase']); ?>" data-bs-toggle="modal"
                                data-bs-target="#editClassModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr id="no-result" style="display: none;">
                        <td colspan="10">
                            <div class="no-result-container">
                                <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Modal Modificar-->
        <div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Clase</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editClassForm">
                            <div class="mb-3">
                                <label for="classId" class="form-label">ID Clase</label>
                                <input type="text" class="form-control" id="classId" name="classId" disabled>
                                <!-- No se edita -->
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <select class="form-control" id="classUserID" name="classUserID">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="starthour" class="form-label">Hora Inicio</label>
                                <input type="time" class="form-control" id="starthour" name="starthour">
                            </div>
                            <div class="mb-3">
                                <label for="endhour" class="form-label">Hora Fin</label>
                                <input type="time" class="form-control" id="endhour" name="endhour">
                            </div>
                            <div class="mb-3">
                                <label for="day" class="form-label">Día</label>
                                <select class="form-control" id="day" name="day">
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
                                <label for="classname" class="form-label">Nombre Clase</label>
                                <input type="text" class="form-control" id="classname" name="classname">
                            </div>
                            <div class="mb-3">
                                <label for="classCategoryID" class="form-label">Categoria</label>
                                <select class="form-control" id="classCategoryID" name="classCategoryID">

                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="updateClassDataBtn">
                            Guardar Cambios
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <?php endif; ?>
        <!-- Vista de Clases Miembros -->
        <?php if ($userRole == 4): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#viewClassDetails">Ver detalles de la Clase</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Modal Crear-->
        <div class="modal fade" id="createAsignatureModal" tabindex="-1" aria-labelledby="createAsignatureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Realizar Nueva Clase</h5>
                    </div>
                    <div class="modal-body">
                        <form id="createClassForm">
                            <div class="mb-3">
                                <label for="classUserID" class="form-label">Nombre de Entrenador</label>
                                <select class="form-select" id="classUserID" name="classUserID">
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
                                <select class="form-control" id="newDay" name="newDay">
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
                                <label for="newClassName" class="form-label">Nombre Clase</label>
                                <input type="text" class="form-control" id="newClassName" name="newClassName">
                            </div>
                            <div class="mb-3">
                                <label for="newCategoryClass" class="form-label">Categoria</label>
                                <input type="number" class="form-control" id="newCategoryClass" name="newCategoryClass">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="createClassBTN">
                            Guardar Cambios
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Ver Detalles de la Clase-->
    <div class="modal fade" id="viewClassDetails" tabindex="-1" aria-labelledby="viewClassDetailsLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de la Clase</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="trainerName" class="form-label">Nombre del Entrenador</label>
                        <input type="text" class="form-control" id="trainerName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Hora Inicio</label>
                        <input type="time" class="form-control" id="startTime" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">Hora Fin</label>
                        <input type="time" class="form-control" id="endTime" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="day" class="form-label">Día</label>
                        <input type="text" class="form-control" id="day" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="className" class="form-label">Nombre de la Clase</label>
                        <input type="text" class="form-control" id="className" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="cancelClass()">
                        Cancelar Clase
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php require './View/fragments/footer.php'; ?>

</body>

</html>