<?php

class Rutas
{
    function LoadController($Controller)
    {
        // Formatea el nombre del controlador para seguir la convención de nomenclatura.
        // Ejemplo: convierte "home" a "HomeController".
        $nombreController = ucwords(strtolower($Controller)) . "Controller";

        // Construye la ruta del archivo del controlador basándose en el nombre del controlador.
        $archivoController = "./Controller/" . ucwords(strtolower($Controller)) . "Controller.php";

        // Verifica si el archivo del controlador existe. Si no, utiliza el controlador predeterminado.
        if (!is_file($archivoController))
        {
            $nombreController = MAIN_CONTROLLER; // Controlador predeterminado
            $archivoController = FIXED_PATH; // Ruta del controlador predeterminado
        }

        // Incluye el archivo del controlador.
        require_once $archivoController;

        // Instancia el controlador.
        $ControllerObjeto = new $nombreController();

        // Devuelve la instancia del controlador.
        return $ControllerObjeto;
    }

    function LoadAction($Controller,$action)
    {
        if(isset($action) && method_exists($Controller, $action))
        {
            $Controller->$action();
        }
        else
        {
            require_once FIXED_PATH;
            $Controller=new IndexPageController();
            $Controller->Index();
        }
    }
}

