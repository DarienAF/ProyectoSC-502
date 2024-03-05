<?php

class Rutas
{
    function LoadController($Controller)
    {
        $nombreController= ucwords(strtolower($Controller)) . "Controller";
        $archivoController="./Controller/".ucwords(strtolower($Controller))."Controller.php";

        if(!is_file($archivoController))
        {
            $nombreController=MAIN_CONTROLLER;
            $archivoController=FIXED_PATH;
        }

        require_once $archivoController;
        $ControllerObjeto= new $nombreController();
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
