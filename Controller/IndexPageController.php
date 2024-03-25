<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class IndexPageController
{

    function Index()
    {
        $current_page = 'LandingPage';

        if (isset($_SESSION['user_id'])) {
            $current_page = 'HomePage';
            $user_id = $_SESSION['user_id'];
            $usuarioM = new UsuarioM();
            $current_user = $usuarioM->view($user_id);
            $userFullName = $current_user->getFullName();
            $userRole = $current_user->getIdRol();

            require_once './View/views/private/HomePage.php';
        } else {
            $usuario = null;
            require_once './View/views/public/LandingPage.php';
        }
    }
}
