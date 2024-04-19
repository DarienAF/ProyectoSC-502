<?php

namespace ProyectoSC502\Model\Entities;

use ProyectoSC502\Model\Methods\EjerciciosM;
use ProyectoSC502\Model\Methods\PlanEjerciciosM;
use ProyectoSC502\Model\Methods\UsuarioM;

class Planes
{
    private $id_plan;
    private $nombre_plan;
    private $id_usuario;
    private $id_plan_ejercicio;
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


    public function getIdUsuarioName()
    {
        $usuarioM = new UsuarioM();
        return $usuarioM->view($this->id_usuario)->getNombre();
    }

    public function getIdPlanEjercicio()
    {
        return $this->id_plan_ejercicio;
    }

    public function getIdPlanEjercicioName()
    {
        $planEjerciciosM = new PlanEjerciciosM();
        $planEjercicios = $planEjerciciosM->view($this->id_plan_ejercicio);
        $ejercicioM = new EjerciciosM();
        $ejercicio = $ejercicioM->view($planEjercicios->getIdEjercicio());
        return $ejercicio->getNombreEjercicio() . " " . $planEjercicios->getSeries() . "x" . $planEjercicios->getRepeticiones();
    }

    public function setIdPlanEjercicio($id_plan_ejercicio)
    {
        $this->id_plan_ejercicio = $id_plan_ejercicio;
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
        $this->setIdPlanEjercicio($row['id_plan_ejercicio']);
        $this->setDia($row['dia']);
    }

    public function toArray(): array
    {
        return [
            'id_plan' => $this->getIdPlan(),
            'nombre_plan' => $this->getNombrePlan(),
            'id_usuario' => $this->getIdUsuario(),
            'id_plan_ejercicio' => $this->getIdPlanEjercicio(),
            'dia' => $this->getDia()
        ];
    }

}