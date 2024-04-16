<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>


<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

        <?php if ($userRole == 1 || $userRole == 3): ?>
        <h1 class="welcomeMessage">Reservas</h1>

        <div class="table-container">
            <table class="table table-striped table-dark" id="tablaReserva">
                <thead>
                    <tr class="table-titles">
                        <th id="sortID">ID Reserva <span class="sort-arrow"></span></th>
                        <th id="sortUsername">Nombre de Usuario <span class="sort-arrow"></span></th>
                        <th id="sortDay">Día <span class="sort-arrow"></span></th>
                        <th id="sortClassName">Nombre Clase <span class="sort-arrow"></span></th>
                        <th id="sortStartTime">Hora Inicio <span class="sort-arrow"></span></th>
                        <th id="sortEndTime">Hora Finalización <span class="sort-arrow"></span></th>
                        <th id="sortStatus">Estado<span class="sort-arrow"></span></th>
                        <th></th>
                    </tr>

                    <tr>
                        <th><input type="number" id="searchId" placeholder="Buscar" oninput="filterTable()"
                                class="form-control">
                        </th>
                        <th><input type="text" id="searchUserName" placeholder="Buscar" oninput="filterTable()"
                                class="form-control">
                        </th>
                        <th><input type="text" id="searchDay" placeholder="Buscar" oninput="filterTable()"
                                class="form-control">
                        </th>
                        <th><input type="text" id="searchClassName" placeholder="Buscar" oninput="filterTable()"
                                class="form-control">
                        </th>

                        <th>
                            <input type="time" id="searchStartTime" placeholder="Hora Inicio" oninput="filterTable()"
                                class="form-control">
                        </th>

                        <th>
                            <input type="time" id="searchEndTime" placeholder="Hora Fin" oninput="filterTable()"
                                class="form-control">
                        </th>

                        <th>
                            <select id="searchStatus" class="form-select" onchange="filterTable()">
                                <option value="">Todos</option>
                                <option value="activa">Activa</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </th>
                        <th>
                        </th>
                    </tr>


                </thead>

                <tbody>

                    <?php foreach ($bookings as $booking): ?>
                    <tr id="bookingRow-<?php echo $booking->getIdReserva(); ?>">
                        <td id="bookingId-<?php echo $booking->getIdReserva(); ?>">
                            <?php echo htmlspecialchars($booking->getIdReserva()); ?>
                        </td>

                        <td id="userName-<?php echo $booking->getIdReserva(); ?>">

                            <?php
                                    $usuario = $usuarioM->view($booking->getIdUsuario());
                                    echo htmlspecialchars($usuario->getNombre() . ' ' . $usuario->getApellidos()); ?>
                        </td>

                        <td id="bookingDay-<?php echo $booking->getIdReserva(); ?>">
                            <?php
                                    $clase = $claseM->view($booking->getIdClase());
                                    echo htmlspecialchars($clase->getDia()); ?>
                        </td>

                        <td id="bookingClassName-<?php echo $booking->getIdReserva(); ?>">
                            <?php
                                    echo htmlspecialchars($clase->getNombreClase());
                                    ?>
                        </td>

                        <td id="bookingClassStartTime-<?php echo $booking->getIdReserva(); ?>">
                            <?php
                                    $horaInicio = strtotime($clase->getHoraInicio());
                                    echo date("h:i A", $horaInicio);
                                    ?>
                        </td>

                        <td id="bookingClassEndTime-<?php echo $booking->getIdReserva(); ?>">
                            <?php
                                    $horaFin = strtotime($clase->getHoraFin());
                                    echo date("h:i A", $horaFin);
                                    ?>
                        </td>



                        <td class="<?php echo $booking->getCancelar() ? 'estado-activa' : 'estado-cancelada'; ?>">
                            <button class="btn btn-toggle"
                                data-state="<?php echo $booking->getCancelar() ? 'activa' : 'cancelada'; ?>"
                                data-booking-id="<?php echo $booking->getIdReserva(); ?>"
                                data-class-name="<?php echo $clase->getNombreClase(); ?>">
                                <?php echo htmlspecialchars($booking->getCancelar()) ? 'Activa' : 'Cancelada'; ?>
                            </button>
                        </td>

                        <td>
                            <button type="button" class="btn btn-warning edit-booking-btn"
                                data-booking-id="<?php echo $booking->getIdReserva() ?>"
                                data-class-name="<?php echo $clase->getNombreClase(); ?>"
                                data-class-id="<?php echo $clase->getIdClase(); ?>" data-bs-toggle="modal"
                                data-bs-target="#editBookingModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                        </td>
                    </tr>
                    <?php endforeach; ?>



                    <tr id="no-result" style="display: none;">
                        <td colspan="9">
                            <div class="no-result-container">
                                <img src="./View/img/private/look-userPage/no_results.png" alt="No hay resultados" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>


        <!-- Modal Editar Reserva -->
        <div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog custom-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Reserva</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editBookingForm">
                            <div class="mb-3">
                                <label for="bookingId" class="form-label">ID</label>
                                <input type="text" class="form-control" id="bookingId" name="bookingId" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bookingClassDay" class="form-label">Día</label>
                                <select class="form-select" id="bookingClassDay" name="bookingClassDay">

                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sábado">Sábado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <h6 class="modal-title"><b>Lista de Clases para el día</b></h6>
                            </div>

                            <div class="mb-3">
                                <div class="row" id="classCards">
                                    <?php foreach ($classes as $cls): ?>
                                    <div class="col-md-4" data-day="<?php echo htmlspecialchars($cls->getDia()); ?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo htmlspecialchars($cls->getNombreClase()); ?>
                                                </h5>
                                                <p class="card-text">Hora Inicio:
                                                    <?php echo date("h:i A", strtotime($cls->getHoraInicio())); ?>
                                                </p>
                                                <p class="card-text">Hora Finalización:
                                                    <?php echo date("h:i A", strtotime($cls->getHoraFin())); ?>
                                                </p>
                                                <button type="button" class="btn btn-edit"
                                                    onclick="selectClass(<?php echo $cls->getIdClase(); ?>, '<?php echo $cls->getNombreClase(); ?>')">Seleccionar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>


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
    </div>

    <?php require './View/fragments/footer.php'; ?>

    <script src="./View/js/crudReservas/reservesPage.js"></script>
</body>

</html>