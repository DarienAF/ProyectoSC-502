<?php
require_once './Model/Connection.php';
require_once './Model/Entities/Rol.php';

class RolM{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }


    function ViewAll()
    {
        $roles = [];

        $query = 'SELECT * FROM `ROL`';
        $result = $this->connection->Query($query);

        while ($row = $result->fetch_assoc()) {
            $rol = new Rol();
            $this->setRolFields($rol, $row);
            $roles[] = $rol;
        }

        return $roles;
    }

    function View($id)
    {
        $rol = new Rol();

        $query = "SELECT * FROM `ROL` WHERE `id_rol` = ?";

        $statement = $this->connection->Prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->setRolFields($rol, $row);
        } else {
            $rol = null;
        }

        return $rol;
    }


    function setRolFields(Rol $rol, array $row)
    {
        $rol->setIdRol  ($row["id_rol"]);
        $rol->setNombre ($row["nombre"]);
    }
}