<?php

namespace ProyectoSC502\Model\Entities;

class Planes
{
    private $id_plan;
    private $nombre_plan;
    private $id_usuario;
    private $dia;

    public function getIdPlan()
    {
        return $this->id_plan;
    }

    public function setIdPlan($id_plan)
    {
        $this->id_plan = $id_plan;
    }

    public function getNombrePlan()
    {
        return $this->nombre_plan;
    }

    public function setNombrePlan($nombre_plan)
    {
        $this->nombre_plan = $nombre_plan;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function setDia($dia)
    {
        $this->dia = $dia;
    }

    public function setPlanesFields($row)
    {
        $this->setIdPlan($row['id_plan']);
        $this->setNombrePlan($row['nombre_plan']);
        $this->setIdUsuario($row['id_usuario']);
        $this->setDia($row['dia']);
    }

    public function toArray()
    {
        return [
            'id_plan' => $this->getIdPlan(),
            'nombre_plan' => $this->getNombrePlan(),
            'id_usuario' => $this->getIdUsuario(),
            'dia' => $this->getDia()
        ];
    }

}