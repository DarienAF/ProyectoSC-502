<div class="nav-container">
    <div class="nav-left">
        <a href="./">
            <img src="./View/img/logos/Logo2.png" alt="Home" class="nav-logo">
        </a>
    </div>

    <div class="nav-right">
        <ul class="nav justify-content-end container-fluid">
            <li>
                <a class="nav-link <?php echo ($current_page == 'IndexPage') ? 'active' : ''; ?>"
                   href="./">
                    INICIO
                </a>
            </li>

            <li>
                <a class="nav-link <?php echo ($current_page == 'LoginPage') ? 'active' : ''; ?>"
                   href="./index.php?controller=LoginPage&action=<?php echo ($current_user != null) ? 'LogOut' : 'index'; ?>">
                    <?php echo ($current_user != null) ? 'CERRAR SESION' : 'INICIAR SESION'; ?>
                </a>
            </li>

            <li>
                <a class="redButton nav-link <?php echo ($current_user != null) ? 'd-none' : ''; ?>"
                   href="./index.php?controller=SignUpPage&action=index">
                    ¡ÚNETE YA!
                </a>
            </li>

            <li>
                <a class="nav-link <?php echo ($current_page == 'PricePage') ? 'active' : ''; ?>"
                   href="./index.php?controller=PricePage&action=index">
                    PRECIOS
                </a>
            </li>

            <li>
                <a class="nav-link <?php echo ($current_page == 'ContactPage') ? 'active' : ''; ?>"
                   href="./index.php?controller=ContactPage&action=index">
                    CONTACTOS
                </a>
            </li>

        </ul>
    </div>

</div>
