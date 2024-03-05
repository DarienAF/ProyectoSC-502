<?php
    require_once './Core/RutaFija.php';
    require_once './Core/Rutas.php';
    
    $ruta=new Rutas();

    //verifica si en la url lleve "controller={}"
    if(isset($_GET['controller']))
    {
        //aqui asigna el controller que se le haya pasado por la url
        $controller=$ruta->LoadController($_GET['controller']);
        //verifica si en la url lleve "accion={}"
        if(isset($_GET['action']))
        {
            $ruta->LoadAction($controller, $_GET['action']);
        }
        else
        {
            $ruta->LoadAction($controller, MAIN_ACTION);
        }
    }
    else
    {
        $controller=$ruta->LoadController(MAIN_CONTROLLER);
        $ruta->LoadAction($controller, MAIN_ACTION);
    }
