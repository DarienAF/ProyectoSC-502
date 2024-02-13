<?php
    require_once './Core/RutaFija.php';
    require_once './Core/Rutas.php';
    
    $ruta=new Rutas();

    //verifica si en la url lleve "controlador={}"
    if(isset($_GET['controlador']))
    {
        //aqui asigna el controlador que se le haya pasado por la url
        $controlador=$ruta->CargarControlador($_GET['controlador']);
        //verifica si en la url lleve "accion={}"
        if(isset($_GET['accion']))
        {
            $ruta->CargarAccion($controlador, $_GET['accion']);
        }
        else
        {
            $ruta->CargarAccion($controlador, ACCION_PRINCIPAL);
        }
    }
    else
    {
        $controlador=$ruta->CargarControlador(CONTROLADOR_PRINCIPAL);
        $ruta->CargarAccion($controlador, ACCION_PRINCIPAL);
    }
