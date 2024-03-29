<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
    <?php require './View/fragments/nav_private.php'; ?>

    <div class="content">

        <?php if ($userRole == 1 || $userRole == 3): ?>
            <h1 class="welcomeMessage">Reservas</h1>
            <div class="add-asignature-container">
                <button type="button" class="btn btn-light add-asignature-btn" data-bs-toggle="modal"
                    data-bs-target="#createAsignatureModal">Crear Nueva
                </button>
            </div>

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
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- TO-DO -->
                        <!-- Modificar body del table -->
                        <tr>
                            <td>1</td>
                            <td>Test Name</td>
                            <td>Hoy</td>
                            <td>Yoga</td>
                            <td class="estado-activa">
                                <button class="btn btn-toggle" data-state="activa" data-booking-id="" data-class-name="">
                                    Activa
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning edit-user-btn" data-user-id=""
                                    data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Test Name</td>
                            <td>Hoy</td>
                            <td>Yoga</td>
                            <td class="estado-activa">
                                <button class="btn btn-toggle" data-state="activa" data-booking-id="" data-class-name="">
                                    Activa
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning edit-user-btn" data-user-id=""
                                    data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>

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

        <?php if ($userRole == 4): ?>
            <h1 class="welcomeMessage">Hacer Reservación</h1>
            <div class="reservation-form container">
                <div class="row">
                    <div class="col-md-6">
                        <p>¡Bienvenido/a!</p>
                        <p>Estamos encantados de que estés considerando unirte a nosotros para una experiencia única y
                            emocionante. Antes de que reserves tu lugar, nos gustaría asegurarnos de que estés
                            completamente
                            preparado/a para disfrutar al máximo de tu tiempo con nosotros.</p>
                        <p>Sigue estos sencillos pasos para garantizar una experiencia increíble:</p>
                        <ol>
                            <li>Selecciona la clase a la que deseas asistir.</li>
                            <li>Confirma que el horario de la clase se ajuste a tu agenda.</li>
                            <li>¡Prepárate para sudar y vivir una experiencia inolvidable!</li>
                        </ol>
                        <p>¡Estamos ansiosos por tenerte en nuestras clases y compartir contigo una experiencia llena de
                            energía, diversión y superación personal!</p>
                    </div>

                    <div class="additional-content col-md-6">
                        <img src="./View/img/private/bookings-page/form-image.jpg" alt="Imagen 1" class="img-fluid">
                    </div>
                </div>

                <div class="form-container row">
                    <form action="#" method="post" class="reservation-form col">
                        <div class="form-group">
                            <label for="class-dropdown">Clase:</label>
                            <select id="class-dropdown" name="class-dropdown" class="form-select">
                                <option value="yoga" class="dropdown-item">Yoga</option>
                                <option value="pilates" class="dropdown-item">Pilates</option>
                                <option value="zumba" class="dropdown-item">Zumba</option>
                            </select>

                            <label for="day">Día</label>
                            <input type="date" id="day" name="day" class="form-control">

                            <label for="hour">Hora</label>
                            <input type="time" id="hour" name="hour" class="form-control">

                            <!-- Crear funcion createBooking y que muestre una alerta segun sea necesario -->
                            <button type="button" class="btn btn-primary" onclick="createBooking()">Hacer Reserva</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php require './View/fragments/footer.php'; ?>

</body>

</html>