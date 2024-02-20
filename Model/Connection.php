<?php

class Connection
{
    private $mysqli;
    
    function Ejecutar($query)
    {
        $name="prueba";
        $user="prueba";
        $pass="123456";
        
        if(!$this->mysqli=new mysqli('localhost',$user,$pass,$name))
        {
            die('Error en conexion('. mysqli_connect_errno().')'. mysqli_connect_error());
        }
        
        $this->mysqli->autocommit(TRUE);
        $resultado= $this->mysqli->query($query);
        return $resultado;
    }
    
    function Cerrar()
    {
        $this->mysqli->close();
    }
}
