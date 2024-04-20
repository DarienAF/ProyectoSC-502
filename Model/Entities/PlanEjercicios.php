<?php

namespace ProyectoSC502\Model\Entities;

class PlanEjercicios
{
    private $id_plan_ejercicio;
    private $id_ejercicio;
    private $series;
    private $repeticiones;


    public function getIdPlanEjercicio()
    {
        return $this->id_plan_ejercicio;
    }

    public function setIdPlanEjercicio($id_plan_ejercicio)
    {
        $this->id_plan_ejercicio = $id_plan_ejercicio;
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
        $this->setIdPlanEjercicio($row['id_plan_ejercicio']);
        $this->setIdEjercicio($row['id_ejercicio']);
        $this->setSeries($row['series']);
        $this->setRepeticiones($row['repeticiones']);
    }

    public function toArray(): array
    {
        return [
            'id_plan_ejercicio' => $this->getIdPlanEjercicio(),
            'id_ejercicio' => $this->getIdEjercicio(),
            'series' => $this->getSeries(),
            'repeticiones' => $this->getRepeticiones()
        ];
    }
}