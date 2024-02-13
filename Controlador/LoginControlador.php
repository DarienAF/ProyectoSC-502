<?php
session_start();
require_once './Modelo/Conexion.php';

class LoginControlador {

    function Index()
    {
        require_once './Vista/Login.php';
    }

}
