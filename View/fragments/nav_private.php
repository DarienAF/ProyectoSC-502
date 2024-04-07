<div class="nav">
    <div class="nav-left">
        <a href="./"><img class="nav-logo" src="./View/img/logos/Logo2.png" alt="Home"></a>
        <a href="./"><img class="nav-profile-pic" src=<?php echo $userImagePath ?> alt="Home"></a>
        <p><?php echo $current_user->getFullName() ?></p>
    </div>

    <div class="nav-right">
        <ul class="nav-menu">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'HomePage') ? 'active' : ''; ?>" href="./">
                    INICIO
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo ($current_page == 'ProfilePage' || ($userRole == 4 && ($current_page == 'SchedulePage' || $current_page == 'LookMeasurePage'))) ? 'active' : ''; ?>"
                    data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MI
                    PERFIL
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ProfilePage&action=index">Mis Datos</a>
                    <?php echo ($userRole == 4) ?
                        ('
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./index.php?controller=TrainingPlanPage&action=index">Mis Rutinas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Mis Horarios</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./index.php?controller=LookMeasurePage&action=index">Mis Medidas</a>
                    ')
                        : '' ?>
                </div>
            </li>

            <?php echo ($userRole == 1 || $userRole == 3) ?
                ('
                            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'NewMeasurePage' || $current_page == 'LookMeasurePage') ? 'active' : '') . '
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >MEDIDAS
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=LookMeasurePage&action=index">Ver Medidas</a>
                </div>
            </li>
                ')
                : '' ?>

            <?php echo ($userRole != 4) ?
                ('<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . (($current_page == 'LookUserPage') ? 'active' : '') . '" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">USUARIOS
                    </a>
                    <div class="dropdown-menu dropdown-menu-dark">
                        <a class="dropdown-item" href="./index.php?controller=LookUserPage&action=index">Ver Usuarios</a>
                    </div>
                </li>')
                : '' ?>

            <?php echo ($userRole != 2) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'ClassesPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >CLASES
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ClassesPage&action=index">Ver clases</a>
                </div>
            </li>')
                : '' ?>


            <?php echo ($userRole == 1 || $userRole == 3) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'ReservesPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >RESERVAS
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ReservesPage&action=index">Ver reservas</a>
                </div>
            </li>')
                : '' ?>

            <?php echo ($userRole == 1 || $userRole == 3) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'TrainingPlanPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >PLANES
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=TrainingPlanPage&action=index">Ver planes</a>
                </div>
            </li>')
                : '' ?>

            <?php echo ($userRole == 1 || $userRole == 2) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'MessagesPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >MENSAJES
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=MessagesPage&action=index">Ver mensajes</a>
                </div>
            </li>')
                : '' ?>

            <?php echo ($userRole == 1) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'ReservesPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >RESERVAS
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ReservesPage&action=index">Ver reservas</a>
                </div>
            </li>')
                : '' ?>

            <?php echo ($userRole == 1) ?
                ('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ' . (($current_page == 'ReportsPage') ? 'active' : '') . '"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                >REPORTES
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ReportsPage&action=index">Ver reportes</a>
                </div>
            </li>')
                : '' ?>

            <li class="nav-item">
                <a class="nav-link"
                    href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                    <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                </a>
            </li>

        </ul>
    </div>
</div>