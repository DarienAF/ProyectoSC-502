<?php
session_start();
require_once './Modelo/Conexion.php';

class IndexControlador {

    function Index()
    {
        require_once './Vista/home.php';
    }

}
