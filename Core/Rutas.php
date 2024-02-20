<?php

class Rutas
{
    function CargarControlador($controlador)//estudiante
    {
        $nombreControlador= ucwords(strtolower($controlador)) . "Controller";
        $archivoControlador="./Controller/".ucwords(strtolower($controlador))."Controller.php";

        if(!is_file($archivoControlador))
        {
            $nombreControlador="IndexPageController";
            $archivoControlador=RUTA_FIJA;
        }

        require_once $archivoControlador;
        $controladorObjeto= new $nombreControlador();
        return $controladorObjeto;
    }
    //Cargar la accion del controlador pasado por la url ejemplo = ...../php?controlador=estudiante&accion=Index
    //carga el index del controlador estudiante
    function CargarAccion($controlador,$accion)
    {
        if(isset($accion) && method_exists($controlador, $accion))
        {
            $controlador->$accion();
        }
        else
        {
            require_once RUTA_FIJA;
            $controlador=new IndexPageController();
            $controlador->Index();
        }
    }
}
