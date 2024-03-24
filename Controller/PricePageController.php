<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';

class PricePageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'PricePage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            $user_rol = $_SESSION['rol'];
            require_once './View/views/public/PricePage.php';
        } else {
            $current_user = null;
            require_once './View/views/public/PricePage.php';
        }
    }
}
