<?php
require_once './Core/RutaFija.php';
require_once './Core/Rutas.php';

<<<<<<< HEAD
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
=======
$ruta = new Rutas();

// Verifica si en la URL se incluye "controller={}"
if (isset($_GET['controller'])) {
    // Aquí asigna el controlador que se le haya pasado por la URL
    $controller = $ruta->LoadController($_GET['controller']);
    // Verifica si en la URL se incluye "action={}"
    if (isset($_GET['action'])) {
        $ruta->LoadAction($controller, $_GET['action']);
    } else {
>>>>>>> Darien
        $ruta->LoadAction($controller, MAIN_ACTION);
    }
} else {
    $controller = $ruta->LoadController(MAIN_CONTROLLER);
    $ruta->LoadAction($controller, MAIN_ACTION);
}
