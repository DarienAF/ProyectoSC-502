<?php
require_once './Core/RutaFija.php';
require_once './Core/Rutas.php';

$ruta = new Rutas();

// Verifica si en la URL se incluye "controller={}"
if (isset($_GET['controller'])) {
    // Aquí asigna el controlador que se le haya pasado por la URL
    $controller = $ruta->LoadController($_GET['controller']);
    // Verifica si en la URL se incluye "action={}"
    if (isset($_GET['action'])) {
        $ruta->LoadAction($controller, $_GET['action']);
    } else {
        $ruta->LoadAction($controller, MAIN_ACTION);
    }
} else {
    $controller = $ruta->LoadController(MAIN_CONTROLLER);
    $ruta->LoadAction($controller, MAIN_ACTION);
}
