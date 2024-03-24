<?php
session_start();
require_once './Model/Connection.php';
require_once  './Model/Methods/UsuarioM.php';


class LookMeasurePageController {

    function Index()
    {
        $current_page = 'LookMeasurePage';
        $current_user = $_SESSION['usuario'];
        $user_rol = $_SESSION['rol'];
        require_once './View/views/private/LookMeasurePage.php';
    }
}
