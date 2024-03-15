<?php

class PlanEjercicios
{
    private $id_plan;
    private $id_ejercicio;
    private $series;
    private $repeticiones;

    public function getIdPlan()
    {
        return $this->id_plan;
    }

    public function setIdPlan($id_plan)
    {
        $this->id_plan = $id_plan;
    }

    public function getIdEjercicio()
    {
        return $this->id_ejercicio;
    }

    public function setIdEjericio($id_ejercicio)
    {
        $this->id_ejercicio = $id_ejercicio;
    }

    public function getSeries()
    {
        return $this->series;
    }

    public function setSeries($series)
    {
        $this->series = $series;
    }

    public function getRepeticiones()
    {
        return $this->repeticiones;
    }

    public function setRepeticiones($repeticiones)
    {
        $this->repeticiones = $repeticiones;
    }

}