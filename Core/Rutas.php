<?php

namespace ProyectoSC502\Core;

use ProyectoSC502\Core\RutaFija;
use ProyectoSC502\Controller\IndexPageController;

class Rutas
{
    function LoadController($controller)
    {

        // Formatea el nombre del controlador para seguir la convención de nomenclatura.
        // Ejemplo: convierte "home" a "HomeController".
        $controllerName = ucwords(strtolower($controller)) . "Controller";

        //
        $controllerClass = "\\ProyectoSC502\\Controller\\" . $controllerName;

        // Construye la ruta del archivo del controlador basándose en el nombre del controlador.
        $controllerPath = "./Controller/" . $controllerName . ".php";

        // Verifica si la clase del controlador existe. Si no, utiliza el controlador predeterminado.
        if (!is_file($controllerPath))
        {
            $controllerClass = RutaFija::MAIN_CONTROLLER; // Use the constant from RutaFija
            $controllerPath = RutaFija::FIXED_PATH; // Ruta del controlador predeterminado
        }

        // Instancia el controlador.
        $ControllerInstance = new $controllerClass();
        return $ControllerInstance;
    }

    function LoadAction($Controller,$action)
    {
        if(isset($action) && method_exists($Controller, $action))
        {
            // Llama al metodo si existe
            $Controller->$action();
        } else {
            // Si no existe, llama al defaul
            $defaultAction = RutaFija::MAIN_ACTION;
            $Controller->$defaultAction();
        }
    }
}