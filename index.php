<?php
require_once './vendor/autoload.php';

use ProyectoSC502\Core\Rutas;
use ProyectoSC502\Core\RutaFija;

$ruta = new Rutas();

// Verifica si en la URL se incluye "controller={}"
if (isset($_GET['controller'])) {
    // Aquí asigna el controlador que se le haya pasado por la URL
    $controller = $ruta->LoadController($_GET['controller']);
    // Verifica si en la URL se incluye "action={}"
    if (isset($_GET['action'])) {
        $ruta->LoadAction($controller, $_GET['action']);
    } else {
        $ruta->LoadAction($controller, RutaFija::MAIN_ACTION);
    }
} else {
    $controller = $ruta->LoadController(RutaFija::MAIN_CONTROLLER);
    $ruta->LoadAction($controller, RutaFija::MAIN_ACTION);
}


