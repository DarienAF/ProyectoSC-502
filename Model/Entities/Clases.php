<?php

namespace ProyectoSC502\Model\Entities;

class Clases {
    private $id_clase;
    private $id_usuario;
    private $hora_inicio;
    private $hora_fin;
    private $dia;
    private $nombre_clase;

    public function getIdClase()
    {
        return $this->id_clase;
    }

    public function setIdClase($id_clase)
    {
        $this->id_clase = $id_clase;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getHoraInicio()
    {
        return $this->hora_inicio;
    }

    public function setHoraInicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;
    }

    public function getHoraFin()
    {
        return $this->hora_fin;
    }

    public function setHoraFin($hora_fin)
    {
        $this->hora_fin = $hora_fin;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function setDia($dia)
    {
        $this->dia = $dia;
    }

    public function getNombreClase()
    {
        return $this->nombre_clase;
    }

    public function setNombreClase($nombre_clase)
    {
        $this->nombre_clase = $nombre_clase;
    }



}