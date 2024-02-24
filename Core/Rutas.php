<?php

class Rutas
{
    function LoadController($Controller)//estudiante
    {
        $nombreController= ucwords(strtolower($Controller)) . "Controller";
        $archivoController="./Controller/".ucwords(strtolower($Controller))."Controller.php";

        if(!is_file($archivoController))
        {
            $nombreController="IndexPageController";
            $archivoController=FIXED_PATH;
        }

        require_once $archivoController;
        $ControllerObjeto= new $nombreController();
        return $ControllerObjeto;
    }
    //Cargar la action del Controller pasado por la url ejemplo = ...../php?Controller=estudiante&action=Index
    //carga el index del Controller estudiante
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
