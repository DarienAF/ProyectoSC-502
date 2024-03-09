<?php

class Planes
{
    private $id_plan;
    private $nombre_plan;
    private $id_usuario;

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


}