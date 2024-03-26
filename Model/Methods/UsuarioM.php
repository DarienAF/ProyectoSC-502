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

    function create(Usuario $usuario)
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
                      `id_rol`,
                        `password_flag`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
            $statement->bindValue(10, $usuario->getPasswordFlag());

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }

    function update(Usuario $usuarioActualizado, Usuario $usuarioOriginal)
    {
        $updates = [];
        $params = [];

        if ($usuarioActualizado->getUsername() != $usuarioOriginal->getUsername()) {
            $updates[] = "`username` = ?";
            $params[] = $usuarioActualizado->getUsername();
        }
        if ($usuarioActualizado->getNombre() != $usuarioOriginal->getNombre()) {
            $updates[] = "`nombre` = ?";
            $params[] = $usuarioActualizado->getNombre();
        }
        if ($usuarioActualizado->getApellidos() != $usuarioOriginal->getApellidos()) {
            $updates[] = "`apellidos` = ?";
            $params[] = $usuarioActualizado->getApellidos();
        }
        if ($usuarioActualizado->getCorreo() != $usuarioOriginal->getCorreo()) {
            $updates[] = "`correo` = ?";
            $params[] = $usuarioActualizado->getCorreo();
        }
        if ($usuarioActualizado->getTelefono() != $usuarioOriginal->getTelefono()) {
            $updates[] = "`telefono` = ?";
            $params[] = $usuarioActualizado->getTelefono();
        }
        if ($usuarioActualizado->getIdRol() != $usuarioOriginal->getIdRol()) {
            $updates[] = "`id_rol` = ?";
            $params[] = $usuarioActualizado->getIdRol();
        }

        if (count($updates) > 0) {
            $query = "UPDATE `Usuarios` SET " . implode(", ", $updates) . " WHERE `id_usuario` = ?";
            $params[] = $usuarioActualizado->getIdUsuario();

            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement->rowCount() > 0;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return false;
            }
        }
        return false;
    }

    public function updatePassword($userId, $newPassword, $passwordFlag = false)
    {
        // Obtener la contraseña actual del usuario
        $currentPasswordQuery = "SELECT password FROM usuarios WHERE id_usuario = :userId";
        $stmt = $this->connection->prepare($currentPasswordQuery);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $currentPassword = $stmt->fetchColumn();

        // Comparar la contraseña actual con la nueva
        if (!password_verify($newPassword, $currentPassword)) {
            // Si son diferentes, actualiza la contraseña y el password_flag
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE usuarios SET password = :newPassword, password_flag = :passwordFlag WHERE id_usuario = :userId";
            $updateStmt = $this->connection->prepare($updateQuery);
            $updateStmt->bindParam(':newPassword', $newPasswordHash, PDO::PARAM_STR);
            $updateStmt->bindParam(':passwordFlag', $passwordFlag, PDO::PARAM_INT);
            $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            return $updateStmt->execute();
        }
        return false;
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

    function userLogin($username)
    {
        $usuario = null;
        try {
            $query = "SELECT * FROM `Usuarios` WHERE `username` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $username);
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


    function setActivationStatus($id_usuario, $status)
    {
        $retVal = false;

        try {
            $query = "UPDATE `Usuarios` SET `activo` = ? WHERE `id_usuario` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $status, PDO::PARAM_INT);
            $statement->bindValue(2, $id_usuario, PDO::PARAM_INT);

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }

    function usernameExists($username)
    {
        $exists = false;

        try {
            $query = "SELECT COUNT(*) FROM `Usuarios` WHERE `username` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $username);
            $statement->execute();

            if ($statement->fetchColumn() > 0) {
                $exists = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $exists;
    }

    function emailExists($email)
    {
        $exists = false;

        try {
            $query = "SELECT COUNT(*) FROM `Usuarios` WHERE `correo` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $email);
            $statement->execute();

            if ($statement->fetchColumn() > 0) {
                $exists = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $exists;
    }

}