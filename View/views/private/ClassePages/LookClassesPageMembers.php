<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

        <h1 class="welcomeMessage">Clases</h1>

        <!-- Vista de Clases Miembros -->

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($userClasses as $userCls): ?>
            <div class="col">
                <div class="card">
                    <img src="./View/img/private/classes-page/card.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Clase de <?php echo htmlspecialchars($userCls['nombre_clase']); ?></h5>
                        <p class="card-text">Día de la clase: <?php echo htmlspecialchars($userCls['dia']); ?></p>
                        <p class="card-text">¡Descubre una experiencia única con la clase
                            "<?php echo htmlspecialchars($userCls['nombre_clase']); ?>"! Únete a nosotros para un
                            entrenamiento dinámico que te ayudará a mejorar tu fuerza, resistencia y flexibilidad. ¡No
                            te lo pierdas y lleva tu rutina fitness al siguiente nivel!</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            id="classId-<?php echo $userCls['id_clase']; ?>" data-bs-target="#viewClassDetails"
                            data-hora-inicio="<?php echo htmlspecialchars($userCls['hora_inicio']); ?>"
                            data-hora-fin="<?php echo htmlspecialchars($userCls['hora_fin']); ?>"
                            data-categoria="<?php echo htmlspecialchars($userCls['categoria']); ?>"
                            data-dia="<?php echo htmlspecialchars($userCls['dia']); ?>"
                            data-nombre-coach="<?php echo htmlspecialchars($userCls['usuario_nombre']); ?>"
                            data-apellidos-coach="<?php echo htmlspecialchars($userCls['usuario_apellidos']); ?>"
                            data-nombre-clase="<?php echo htmlspecialchars($userCls['nombre_clase']); ?>"
                            data-id_usuario="<?php echo $user_id; ?>">Ver
                            detalles de la Clase</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

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
                        <button id="createBookingClass" type="button" class="btn btn-success">
                            Reservar Clase
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require './View/fragments/footer.php'; ?>

    <script src="./View/js/crudClases/lookClassesPageMembers.js"></script>

</body>

</html>