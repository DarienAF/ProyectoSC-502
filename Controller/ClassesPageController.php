<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class ClassesPageController
{

    function Index()
    {
        $current_page = 'ClassesPage';
        $current_user = $_SESSION['usuario'];
        $user_rol = $_SESSION['rol'];
        require_once './View/views/private/ClassesPage.php';
    }
}
