<?php
require_once '../config/Conexion.php';

class Rol extends Conexion
{
    /*=============================================
    =            Atributos de la Clase            =
    =============================================*/
    protected static $cnx;
    private $id_rol=null;
    private $nombre= null;
    private $id_usuario= null;
    /*=====  End of Atributos de la Clase  ======*/

    /*=============================================
    =            Contructores de la Clase          =
    =============================================*/
    public function __construct(){}
    /*=====  End of Contructores de la Clase  ======*/

    /*=============================================
    =            Encapsuladores de la Clase       =
    =============================================*/
    public function getIdRol()
    {
        return $this->id_rol;
    }
    public function setIdRol($id_rol)
    {
        $this->id_rol = $id_rol;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    /*=====  End of Encapsuladores de la Clase  ======*/
     /*=============================================
	=            Metodos de la Clase              =
	=============================================*/
    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }





}

?>