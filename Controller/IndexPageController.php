<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class IndexPageController
{

    function Index()
    {
        $current_page = 'LandingPage';

        if (isset($_SESSION['usuario'])) {
            $current_page = 'HomePage';
            $current_user = $_SESSION['usuario'];
            $current_name = $_SESSION['nombre'];
            $user_rol = $_SESSION['rol'];
            require_once './View/views/private/HomePage.php';
        } else {
            $usuario = null;
            require_once './View/views/public/LandingPage.php';
        }
    }
}
