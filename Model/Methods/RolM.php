<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Rol;

class RolM{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function view($id_rol)
    {
        $rol = null;

        try {
            $query = "SELECT * FROM `Rol` WHERE `id_rol` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $id_rol, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $rol = new Rol();
                $rol->setRolFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $rol;
    }

    function viewAll()
    {
        $roles = [];

        try {
            $query = "SELECT * FROM `Rol`";
            $statement = $this->connection->Prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $rol = new Rol();
                $rol->setRolFields($row);
                $roles[] = $rol;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $roles;
    }

    function viewRolesNames()
    {
        $roles = [];

        try {
            $query = "SELECT id_rol, nombre FROM `Rol`";
            $statement = $this->connection->Prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $roles[$row['id_rol']] = $row['nombre'];
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $roles;
    }


}