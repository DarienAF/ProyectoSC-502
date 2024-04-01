<?php

namespace ProyectoSC502\Model\Entities;

class Rol
{
    private $id_rol;
    private $nombre;

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

    function setRolFields(array $row)
    {
        $this->setIdRol($row["id_rol"]);
        $this->setNombre($row["nombre"]);
    }
}
