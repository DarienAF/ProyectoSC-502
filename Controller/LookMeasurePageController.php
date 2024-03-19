<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';


class LookMeasurePageController {

    function Index()
    {
        // Get the current page name
        $current_page = 'LookMeasurePage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/private/LookMeasurePage.php';
        } else {
            $current_user = null;
            require_once './View/views/private/LookMeasurePage.php';
        }
    }
}
