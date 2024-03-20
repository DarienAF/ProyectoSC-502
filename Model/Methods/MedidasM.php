<?php
require_once './Model/Connection.php';
require_once './Model/Entities/Medidas.php';

class MedidasM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function create(Medidas $medida)
    {
        $retVal = false;

        try {
            $query = "INSERT INTO `Usuarios` (
                      `username`, 
                      `password`, 
                      `nombre`, 
                      `apellidos`, 
                      `correo`, 
                      `telefono`, 
                      `ruta_imagen`, 
                      `activo`, 
                      `id_rol`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $statement = $this->connection->Prepare($query);

            // Vincular  valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $usuario->getUsername());
            $statement->bindValue(2, password_hash($usuario->getPassword(), PASSWORD_DEFAULT));
            $statement->bindValue(3, $usuario->getNombre());
            $statement->bindValue(4, $usuario->getApellidos());
            $statement->bindValue(5, $usuario->getCorreo());
            $statement->bindValue(6, $usuario->getTelefono());
            $statement->bindValue(7, $usuario->getRutaImagen());
            $statement->bindValue(8, $usuario->getActivo(), PDO::PARAM_INT); //int
            $statement->bindValue(9, $usuario->getIdRol(), PDO::PARAM_INT); //int

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }


    function update(Medidas $medida)
    {
        $retVal = false;

        try {
            $query = "UPDATE `Usuarios` SET 
                      `username` = ?, 
                      `password` = ?, 
                      `nombre` = ?, 
                      `apellidos` = ?, 
                      `correo` = ?, 
                      `telefono` = ?, 
                      `ruta_imagen` = ?, 
                      `activo` = ?, 
                      `id_rol` = ? WHERE `id_usuario` = ?";

            $statement = $this->connection->Prepare($query);

            // Vincular  valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $usuario->getUsername());
            $statement->bindValue(2, password_hash($usuario->getPassword(), PASSWORD_DEFAULT));
            $statement->bindValue(3, $usuario->getNombre());
            $statement->bindValue(4, $usuario->getApellidos());
            $statement->bindValue(5, $usuario->getCorreo());
            $statement->bindValue(6, $usuario->getTelefono());
            $statement->bindValue(7, $usuario->getRutaImagen());
            $statement->bindValue(8, $usuario->getActivo(), PDO::PARAM_INT); //int
            $statement->bindValue(9, $usuario->getIdRol(), PDO::PARAM_INT); //int
            $statement->bindValue(10, $usuario->getIdUsuario(), PDO::PARAM_INT); //int

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }
        return $retVal;
    }


    function view($id_usuario)
    {
        $usuario = null;

        try {
            $query = "SELECT * FROM `Usuarios` WHERE `id_usuario` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario();
                $usuario->setUserFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $usuario;
    }


    function viewAll()
    {
        $usuarios = [];

        try {
            $query = "SELECT * FROM `Usuarios`";
            $statement = $this->connection->Prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario();
                $usuario->setUserFields($row);
                $usuarios[] = $usuario;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $usuarios;
    }


    function delete($id_medida)
    {
        $retVal = false;

        try {
            $query = "UPDATE `Usuarios` SET `activo` = 1 WHERE `id_usuario` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $id_usuario, PDO::PARAM_INT); //int

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }

}