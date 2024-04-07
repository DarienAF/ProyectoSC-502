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

                        <td class="<?php echo $booking->getCancelar() ? 'estado-activa' : 'estado-cancelada'; ?>">
                            <button class="btn btn-toggle"
                                data-state="<?php echo $booking->getCancelar() ? 'activa' : 'cancelada'; ?>"
                                data-booking-id="<?php echo $booking->getIdReserva(); ?>"
                                data-class-name="<?php echo $clase->getNombreClase(); ?>">
                                <?php echo $booking->getCancelar() ? 'Activa' : 'Cancelada'; ?>
                            </button>
                        </td>

                        <td>
                            <button type="button" class="btn btn-warning edit-user-btn" data-user-id=""
                                data-bs-toggle="modal" data-bs-target="#editUserModal">
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


    </div>

    <?php require './View/fragments/footer.php'; ?>

    <script src="./View/js/crudReservas/reservesPage.js"></script>
</body>

</html>