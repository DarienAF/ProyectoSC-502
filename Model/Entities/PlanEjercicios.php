<?php

namespace ProyectoSC502\Model\Entities;

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

    public function setIdEjercicio($id_ejercicio)
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

    public function setPlanEjerciciosFields($row)
    {
        $this->setIdPlan($row['id_plan']);
        $this->setIdEjercicio($row['id_ejercicio']);
        $this->setSeries($row['series']);
        $this->setRepeticiones($row['repeticiones']);
    }

    public function toArray()
    {
        return [
            'id_plan' => $this->getIdPlan(),
            'id_ejercicio' => $this->getIdEjercicio(),
            'series' => $this->getSeries(),
            'repeticiones' => $this->getRepeticiones()
        ];
    }
}