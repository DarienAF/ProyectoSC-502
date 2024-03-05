<?php

class Planes
{
    private $id_plan;
    private $nombre_plan;
    private $descripcion_plan;
    private $duracion;
    private $costo;
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

    public function getDescripcionPlan()
    {
        return $this->descripcion_plan;
    }

    public function setDescripcionPlan($descripcion_plan)
    {
        $this->descripcion_plan = $descripcion_plan;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    public function getCosto()
    {
        return $this->costo;
    }

    public function setCosto($costo)
    {
        $this->costo = $costo;
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