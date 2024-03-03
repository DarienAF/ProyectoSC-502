<link rel="stylesheet" href="./View/style/fragments/NavStyle.css">

<section id="nav">
    <div class="nav">
        <div class="nav-icon" style="display: flex">
            <a href="./">
                <img src="./View/img/logos/Logo.svg" alt="Home" style="height: 96px; width: 96px;">
            </a>

            <a href="./">
                <img src="./View/img/users/default_user.png" alt="Home" style="height: 64px; width: 64px;">
            </a>
            <p><?php echo $current_user?></p>
        </div>

        <div class="nav-menu">
            <ul class="nav justify-content-end container-fluid">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'currentPage') ? 'active' : ''; ?>"
                       href="./">
                        Mi Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'LoginPage') ? 'active' : ''; ?>"
                       href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                        <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="redButton nav-link <?php echo ($current_user != null) ? 'd-none' : ''; ?>"
                       style="font-family: 'Montserrat Alternates', sans-serif;"
                       href="./index.php?controller=SignUpPage&action=index">
                        ¡ÚNETE YA!
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'ShippingPage') ? 'active' : ''; ?>"
                       href="./index.php?controller=PricePage&action=index">
                        PRECIOS
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'ContactPage') ? 'active' : ''; ?>"
                       href="./index.php?controller=ContactPage&action=index">
                        CONTACTOS
                    </a>
                </li>

            </ul>
        </div>
    </div>
</section>