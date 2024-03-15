<<<<<<< HEAD
<link rel="stylesheet" href="./View/style/fragments/NavStyle.css">
=======

<link rel="stylesheet" href="./View/style/fragments/NavStylePrivate.css">
>>>>>>> Darien

<section id="nav" style="background-color: rgba(1, 1, 1, 1);">
    <div class="nav">
        <div class="nav-icon" style="display: flex">
            <a href="./">
                <img src="./View/img/logos/Logo.svg" alt="Home" style="height: 96px; width: 96px;">
            </a>

<<<<<<< HEAD
            <a href="./">
                <img src="./View/img/users/default_user.png" alt="Home" style="height: 64px; width: 64px;">
            </a>
            <p>
                <?php echo $current_user , $current_page ?>.
=======

            <a class="user-a" href="./">
                <img src="./View/img/users/default_user.png" alt="Home" style="height: 64px; width: 64px; border-radius: 50%;">

            </a>
            <p class="userNameLabel">
                <?php echo $current_user?>
>>>>>>> Darien
            </p>
        </div>

        <div class="nav-menu">
            <ul class="nav justify-content-end container-fluid">
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link <?php echo ($current_page == 'HomePage') ? 'active' : ''; ?>"
                       href="./">
=======
                    <a class="nav-link <?php echo ($current_page == 'HomePage') ? 'active' : ''; ?>" href="./">
>>>>>>> Darien
                        INICIO
                    </a>
                </li>

<<<<<<< HEAD
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'ProfilePage') ? 'active' : ''; ?>"
                        href="./index.php?controller=ProfilePage&action=index">
                        MI PERFIL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="./index.php?controller=SchedulePage&action=index">
                        HORARIOS
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                        <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                    </a>
                </li>
=======

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'ProfilePage' || $current_page == 'SchedulePage') ? 'active' : ''; ?>"
                    href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        MI PERFIL
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=ProfilePage&action=index">Datos</a>
                        </li>
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horarios</a>
                        </li>
                    </ul>
                </li>

                <!-- NAVEGADORES PARA LAS TABLAS (PENDIENTE SUS VISTAS POR ENDE HREF)-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'LookUserPage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        USUARIOS
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=LookUserPage&action=index">Ver Usuarios</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'NewMeasurePage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        MEDIDAS
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=NewMeasurePage&action=index">Registrar</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CLASES
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horario</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PLANES
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horario</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        RESERVAS
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horario</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        MENSAJES
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horario</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                        href="./index.php?controller=SchedulePage&action=index">
                        REPORTES
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./index.php?controller=SchedulePage&action=index">Horario</a>
                        </li>
                        <!-- Agregar mas opciones segun su CRUD -->
                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link"
                        href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                        <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                    </a>
                </li>

>>>>>>> Darien
            </ul>
        </div>
    </div>
</section>