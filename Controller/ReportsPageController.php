<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/UsuarioM.php';


class ReportsPageController
{

    function Index()
    {
        $current_page = 'ReportsPage';
        $current_user = $_SESSION['usuario'];
        $current_name = $_SESSION['nombre'];
        $user_rol = $_SESSION['rol'];
        require_once './View/views/private/ReportsPage.php';
    }
}
