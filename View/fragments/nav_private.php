    <link rel="stylesheet" href="./View/style/fragments/NavStyle.css">

<section id="nav" style="background-color: rgba(1, 1, 1, 1);">
    <div class="nav">
        <div class="nav-icon" style="display: flex">
            <a href="./">
                <img src="./View/img/logos/Logo.svg" alt="Home" style="height: 96px; width: 96px;">
            </a>

            <a class="user-a" href="./">
                <img src="./View/img/users/default_user.png" alt="Home" style="height: 64px; width: 64px; border-radius: 50%;">
            </a>
            <p class="userNameLabel">
                <?php echo $current_user?>
            </p>
        </div>

        <div class="nav-menu">
            <ul class="nav justify-content-end container-fluid">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'HomePage') ? 'active' : ''; ?>"
                       href="./">
                        INICIO
                    </a>
                </li>


                <?php if ($_SESSION['rol'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'ReportsPage') ? 'active' : ''; ?>"
                           href="./">
                            REPORTES
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($_SESSION['rol'] == 4): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'ProfilePage') ? 'active' : ''; ?>"
                           href="./index.php?controller=ProfilePage&action=index">
                            MI PERFIL
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($_SESSION['rol'] == 4): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'SchedulePage') ? 'active' : ''; ?>"
                           href="./index.php?controller=SchedulePage&action=index">
                            HORARIOS
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link"
                       href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                        <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>