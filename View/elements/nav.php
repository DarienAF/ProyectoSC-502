<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<section id="Nav">
    <div class="Nav">
        <ul class="nav justify-content-end container-fluid">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'LandingPage.php') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/">
                    INICIO
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'LoginPage.php') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=Login&accion=index">
                    INICIAR SESIÓN
                </a>
            </li>

            <li class="nav-item">
                <a class="redButton nav-link <?php echo ($current_page == 'SignUpPage.php') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=SignUp&accion=index">
                    ¡ÚNETE YA!
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == '') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=Login&accion=index">
                    PRECIOS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == '') ? 'active' : ''; ?>"
                   href="http://localhost/dashboard/ProyectoSC-502/index.php?controlador=Login&accion=index">
                    CONTACTOS
                </a>
            </li>
        </ul>
    </div>
</section>
