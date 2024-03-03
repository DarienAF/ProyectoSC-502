<?php
require_once './Model/Connection.php';
require_once './Model/Entities/Rol.php';

class RolM{
    function ViewAll()
    {
        $retVal = [];

        $DB = new Connection();

        $sql = 'SELECT * FROM USUARIOS';

        $result = $DB->Query($sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $rol = new Rol();
                $rol->setIdRol  ($row["id_rol"]);
                $rol->setNombre ($row["nombre"]);
                $retVal[] = $rol;
            }
        } else {
            $retVal = null;
        }
        $DB->Close();

        return $retVal;

    }

    function View($id)
    {
        $rol = new Rol();

        $conexion = new Conexion();
        $sql = "SELECT * FROM `Rol` WHERE `id_rol` = " . $id;

        $resultado = $conexion->Ejecutar($sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rol->setIdRol  ($row["id_rol"]);
                $rol->setNombre ($row["nombre"]);
            }
        } else {
            $rol = null;
        }
        $conexion->Cerrar();

        return $rol;

    }
}