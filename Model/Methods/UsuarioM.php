<?php
require_once './Model/Connection.php';
require_once './Model/Entities/Usuario.php';

class UsuarioM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function Create(Usuario $usuario)
    {
        $retVal = false;

        try {
            $query = "INSERT INTO Usuarios (
                      username, 
                      password, 
                      nombre, 
                      apellidos, 
                      correo, 
                      telefono, 
                      ruta_imagen, 
                      activo, 
                      id_rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $statement = $this->connection->Prepare($query);

            $username = $usuario->getUsername();
            $password = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);
            $nombre = $usuario->getNombre();
            $apellidos = $usuario->getApellidos();
            $correo = $usuario->getCorreo();
            $telefono = $usuario->getTelefono();
            $rutaImagen = $usuario->getRutaImagen();
            $activo = $usuario->getActivo();
            $idRol = $usuario->getIdRol();

            $statement->bind_param("sssssssii", $username, $password, $nombre, $apellidos, $correo, $telefono, $rutaImagen, $activo, $idRol);

            if ($statement->execute()) {
                $retVal = true;
            }

            $statement->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }


    function Update(Usuario $usuario)
    {
        $retVal = false;

        try {
            $query = "UPDATE `Usuarios` SET 
                          `username`=?, 
                          `password`=?, 
                          `nombre`=?, 
                          `apellidos`=?, 
                          `correo`=?, 
                          `telefono`=?, 
                          `ruta_imagen`=?, 
                          `id_rol`=? WHERE `id_usuario` = ?";

            $statement = $this->connection->Prepare($query);

            $username = $usuario->getUsername();
            $password = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);
            $nombre = $usuario->getNombre();
            $apellidos = $usuario->getApellidos();
            $correo = $usuario->getCorreo();
            $telefono = $usuario->getTelefono();
            $rutaImagen = $usuario->getRutaImagen();
            $idRol = $usuario->getIdRol();
            $idUsuario = $usuario->getIdUsuario();

            $statement->bind_param("sssssssii", $username, $password, $nombre, $apellidos, $correo, $telefono, $rutaImagen, $idRol, $idUsuario);

            if ($statement->execute()) {
                $retVal = true;
            }

            $statement->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }


    function View($id)
    {
        $usuario = new Usuario();

        $query = "SELECT * FROM `USUARIOS` WHERE `id_usuario` = ?";

        $statement = $this->connection->Prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->setUserFields($usuario, $row);
        } else {
            $usuario = null;
        }

        $statement->close();
        return $usuario;
    }

    function ViewAll()
    {
        $usuarios = [];

        $query = 'SELECT * FROM `USUARIOS`';
        $result = $this->connection->Query($query);

        while ($row = $result->fetch_assoc()) {
            $usuario = new Usuario();
            $this->setUserFields($usuario, $row);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    function setUserFields(Usuario $usuario, array $row)
    {
        $usuario->setIdUsuario($row["id_usuario"]);
        $usuario->setUsername($row["username"]);
        $usuario->setPassword($row["password"]);
        $usuario->setNombre($row["nombre"]);
        $usuario->setApellidos($row["apellidos"]);
        $usuario->setCorreo($row["correo"]);
        $usuario->setTelefono($row["telefono"]);
        $usuario->setRutaImagen($row["ruta_imagen"]);
        $usuario->setActivo($row["activo"]);
        $usuario->setIdRol($row["id_rol"]);
    }

    function Activate($id_usuario)
    {
        $retVal = false;

        $query = "UPDATE `USUARIOS` SET `activo`=? WHERE `id_usuario` = ?";
        $statement = $this->connection->Prepare($query);

        $activo = 1;
        $statement->bind_param("ii", $activo, $id_usuario);

        if ($statement->execute()) {
            $retVal = true;
        }

        $statement->close();

        return $retVal;
    }

    function Deactivate($id_usuario)
    {
        $retVal = false;

        $query = "UPDATE `USUARIOS` SET `activo`=? WHERE `id_usuario` = ?";
        $statement = $this->connection->Prepare($query);

        $activo = 0;
        $statement->bind_param("ii", $activo, $id_usuario);

        if ($statement->execute()) {
            $retVal = true;
        }

        $statement->close();

        return $retVal;
    }


    function UserLogin($user)
    {
        $usuario = new Usuario();

        $sql = "SELECT * FROM USUARIOS WHERE `username` = ?";

        $statement = $this->connection->Prepare($sql);
        $statement->bind_param("s", $user);
        $statement->execute();
        $resultado = $statement->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $usuario->setIdUsuario($fila["id_usuario"]);
            $usuario->setNombre($fila["nombre"]);
            $usuario->setApellidos($fila["apellidos"]);
            $usuario->setUsername($fila["username"]);
            $usuario->setPassword($fila["password"]);
            $usuario->setIdRol($fila["id_rol"]);
        } else {
            $usuario = null;
        }

        $statement->close();

        return $usuario;
    }

}