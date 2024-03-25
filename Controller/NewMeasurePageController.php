<?php
session_start();
require_once './Model/Connection.php';
require_once './Model/Methods/MedidasM.php';


class NewMeasurePageController
{

    function Index()
    {
        $current_page = 'NewMeasurePage';
        $current_user = $_SESSION['usuario'];
        $current_name = $_SESSION['nombre'];
        $user_rol = $_SESSION['rol'];
        require_once './View/views/private/NewMeasurePage.php';
    }
}
