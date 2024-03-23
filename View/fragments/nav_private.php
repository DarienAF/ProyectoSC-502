<link rel="stylesheet" href="./View/style/fragments/NavStylePrivate.css">

<div class="nav">
    <div class="nav-left">
        <a href="./"><img class="nav-logo" src="./View/img/logos/Logo2.png" alt="Home"></a>
        <a href="./"><img class="nav-profile-pic" src="./View/img/users/default_user.png" alt="Home"></a>
        <p><?php echo $current_user ?></p>
    </div>

    <div class="nav-right">
        <ul class="nav-menu">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'HomePage') ? 'active' : ''; ?>" href="./">
                    INICIO
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'ProfilePage' || $current_page == 'SchedulePage') ? 'active' : ''; ?>>MI
                    PERFIL
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ProfilePage&action=index">Datos</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horarios</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'NewMeasurePage' || $current_page == 'LookMeasurePage') ? 'active' : ''; ?>>MEDIDAS
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=NewMeasurePage&action=index">Insertar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./index.php?controller=LookMeasurePage&action=index">Ver Medidas</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'LookUserPage') ? 'active' : ''; ?>>USUARIOS
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=LookUserPage&action=index">Ver Usuarios</a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'ClassesPage') ? 'active' : ''; ?>>CLASES
                    <!-- No tiene Controller -->
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ClassesPage&action=index">Ver clases</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'TrainingPlansPage') ? 'active' : ''; ?>>PLANES
                    <!-- No tiene Controller -->
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=TrainingPlansPage&action=index">Ver planes</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'ReservesPage') ? 'active' : ''; ?>>RESERVAS
                    <!-- No tiene Controller -->
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ReservesPage&action=index">Ver reservas</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'MessagesPage') ? 'active' : ''; ?>>MENSAJES
                    <!-- No tiene Controller -->
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=MessagesPage&action=index">Ver mensajes</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"
                    <?php echo ($current_page == 'ReportsPage') ? 'active' : ''; ?>>REPORTES
                    <!-- No tiene Controller -->
                </a>
                <div class="dropdown-menu dropdown-menu-dark">
                    <a class="dropdown-item" href="./index.php?controller=ReportsPage&action=index">Ver reportes</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                    <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                </a>
            </li>
        </ul>
    </div>
</div>