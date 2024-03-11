<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class SchedulePageController
{

    function Index()
    {
        // Get the current page name
        $current_page = 'SchedulePage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            $user_rol = $_SESSION['rol'];
            require_once './View/views/private/SchedulePage.php';
        } else {
            $current_user = null;
            require_once './View/views/private/LandingPage.php';
        }
    }
}
