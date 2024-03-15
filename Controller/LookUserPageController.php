<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class LookUserPageController
{

    function Index()
    {
        // Get the current page name
        $current_page = 'LookUserPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            require_once './View/views/private/LookUserPage.php';
        } else {
            $current_user = null;
            require_once './View/views/private/LandingPage.php';
        }
    }
}