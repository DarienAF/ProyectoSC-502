<link rel="stylesheet" href="./View/style/NavStyle.css">

<section id="Nav">
    <div class="Nav">
        <ul class="nav justify-content-end container-fluid">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'IndexPage') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/">
                    INICIO
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'LoginPage') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                    <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="redButton nav-link <?php echo ($current_user != null) ? 'd-none' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=SignUpPage&action=index">
                    ¡ÚNETE YA!
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'ShippingPage') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=Login&action=index">
                    PRECIOS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'ContactPage') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controller=Login&action=index">
                    CONTACTOS
                </a>
            </li>
        </ul>
    </div>
</section>
