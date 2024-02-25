<?php
require_once '../config/Conexion.php';

class Usuario extends Conexion
{
    /*=============================================
    =            Atributos de la Clase            =
    =============================================*/
    protected static $cnx;
    private $id_usuario=null;
    private $username=null;
    private $password= null;
    private $nombre= null;
    private $apellidos= null;
    private $correo= null;
    private $telefono= null;
    private $ruta_imagen= null;
    private $activo= null;
    /*=====  End of Atributos de la Clase  ======*/

      // Constructor
      public function __construct(){}

      // Getters y Setters
      public function getIdUsuario()
      {
          return $this->id_usuario;
      }
      public function setIdUsuario($id_usuario)
      {
          $this->id_usuario = $id_usuario;
      }
  
      public function getUsername()
      {
          return $this->username;
      }
      public function setUsername($username)
      {
          $this->username = $username;
      }
  
      public function getPassword()
      {
          return $this->password;
      }
      public function setPassword($password)
      {
          $this->password = $password;
      }
  
      public function getNombre()
      {
          return $this->nombre;
      }
      public function setNombre($nombre)
      {
          $this->nombre = $nombre;
      }
  
      public function getApellidos()
      {
          return $this->apellidos;
      }
      public function setApellidos($apellidos)
      {
          $this->apellidos = $apellidos;
      }
  
      public function getCorreo()
      {
          return $this->correo;
      }
      public function setCorreo($correo)
      {
          $this->correo = $correo;
      }
  
      public function getTelefono()
      {
          return $this->telefono;
      }
      public function setTelefono($telefono)
      {
          $this->telefono = $telefono;
      }
  
      public function getRutaImagen()
      {
          return $this->ruta_imagen;
      }
      public function setRutaImagen($ruta_imagen)
      {
          $this->ruta_imagen = $ruta_imagen;
      }
  
      public function getActivo()
      {
          return $this->activo;
      }
      public function setActivo($activo)
      {
          $this->activo = $activo;
      }

         /*=============================================
          =           Métodos de la Clase               =
          =============================================*/

    // Obtener conexión a la base de datos
    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    // Cerrar la conexión a la base de datos
    public static function desconectar(){
        self::$cnx = null;
    }

    // Listar todos los usuarios
    public function listarTodosDb(){
        $query = "SELECT * FROM usuarios";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $user = new Usuario();
                $user->setIdUsuario($encontrado['id_usuario']);
                $user->setUsername($encontrado['username']);
                $user->setPassword($encontrado['password']);
                $user->setNombre($encontrado['nombre']);
                $user->setApellidos($encontrado['apellidos']);
                $user->setCorreo($encontrado['correo']);
                $user->setTelefono($encontrado['telefono']);
                $user->setRutaImagen($encontrado['ruta_imagen']);
                $user->setActivo($encontrado['activo']);
                $arr[] = $user;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );
            return json_encode($error);
        }
    }

    // Verificar existencia de un usuario por correo electrónico
    public function verificarExistenciaDb(){
        $query = "SELECT * FROM Usuarios where correo=:correo";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);     
            $correo = $this->getCorreo();   
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $encontrado = false;
            foreach ($resultado->fetchAll() as $reg) {
                $encontrado = true;
            }
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    // Guardar un nuevo usuario en la base de datos
    public function guardarEnDb(){
        $query = "INSERT INTO `usuarios`(`username`, `password`, `nombre`, `apellidos`, `correo`, `telefono`, `ruta_imagen`, `activo`) VALUES (:username, :password, :nombre, :apellidos, :correo, :telefono, :ruta_imagen, :activo)";
        try {
            self::getConexion();
            $username = $this->getUsername();
            $password = $this->getPassword();
            $nombre = $this->getNombre();
            $apellidos = $this->getApellidos();
            $correo = $this->getCorreo();
            $telefono = $this->getTelefono();
            $ruta_imagen = $this->getRutaImagen();
            $activo = $this->getActivo();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":username", $username, PDO::PARAM_STR);
            $resultado->bindParam(":password", $password, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_imagen", $ruta_imagen, PDO::PARAM_STR);
            $resultado->bindParam(":activo", $activo, PDO::PARAM_BOOL);
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return json_encode($error);
        }
    }

    // Activar un usuario
    public function activar(){
        $id_usuario = $this->getIdUsuario();
        $query = "UPDATE Usuarios SET activo = true WHERE id_usuario = :id_usuario";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    // Desactivar un usuario
    public function desactivar(){
        $id_usuario = $this->getIdUsuario();
        $query = "UPDATE Usuarios SET activo = false WHERE id_usuario = :id_usuario";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    //REALICE CAMBIOS
    // Mostrar un usuario por correo electrónico
    public static function mostrar($mail){
        $query = "SELECT * FROM Usuarios WHERE correo = :id";
        $id = $mail;
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetch();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    // Llenar los campos de un usuario basado en su ID
    public function llenarCampos($id){
        $query = "SELECT * FROM Usuarios WHERE id_usuario = :id";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $this->setIdUsuario($encontrado['id_usuario']);
                $this->setUsername($encontrado['username']);
                $this->setPassword($encontrado['password']);
                $this->setNombre($encontrado['nombre']);
                $this->setApellidos($encontrado['apellidos']);
                $this->setCorreo($encontrado['correo']);
                $this->setTelefono($encontrado['telefono']);
                $this->setRutaImagen($encontrado['ruta_imagen']);
                $this->setActivo($encontrado['activo']);
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return json_encode($error);
        }
    }

    // Actualiza los campos del usuario 
    public function actualizarUsuario(){
        $query = "UPDATE Usuarios SET username=:username, password=:password, nombre=:nombre, apellidos=:apellidos, correo=:correo, telefono=:telefono, ruta_imagen=:ruta_imagen, activo=:activo WHERE id_usuario=:id_usuario";
        try {
            self::getConexion();
            $id_usuario = $this->getIdUsuario();
            $username = $this->getUsername();
            $password = $this->getPassword();
            $nombre = $this->getNombre();
            $apellidos = $this->getApellidos();
            $correo = $this->getCorreo();
            $telefono = $this->getTelefono();
            $ruta_imagen = $this->getRutaImagen();
            $activo = $this->getActivo();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $resultado->bindParam(":username", $username, PDO::PARAM_STR);
            $resultado->bindParam(":password", $password, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_imagen", $ruta_imagen, PDO::PARAM_STR);
            $resultado->bindParam(":activo", $activo, PDO::PARAM_BOOL);
    
            self::$cnx->beginTransaction(); // desactiva el autocommit
            $resultado->execute();
            self::$cnx->commit(); // realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }

    public function verificarExistenciaEmail(){
        $query = "SELECT correo, id_usuario, nombre, apellidos, telefono FROM Usuarios WHERE correo=:correo AND activo =1";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);		
            $correo = $this->getCorreo();		
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $arr = array();
            foreach ($resultado->fetchAll() as $reg) {
                $arr[] = $reg['id_usuario'];
                $arr[] = $reg['correo'];   
                $arr[] = $reg['nombre'];  
                $arr[] = $reg['apellidos'];
                $arr[] = $reg['telefono'];  
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
        }
    }
}
?>