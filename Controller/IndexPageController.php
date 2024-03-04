<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';

class IndexPageController
{

    function Index()
    {
        $current_page = 'IndexPage';

        if (isset($_SESSION['usuario'])) {
            $current_user = $_SESSION['usuario'];
            $current_page = 'HomePage';
            require_once './View/views/private/HomePage.php';
        } else {
            $current_user = null;
            require_once './View/views/public/LandingPage.php';
        }


    }

}
