<?php

class Reservaciones
{
    private $id_reserva;
    private $id_usuario;
    private $id_clase;
    private $cancelar;

    public function getIdReserva()
    {
        return $this->id_reserva;
    }

    public function setIdReserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getIdClase()
    {
        return $this->id_clase;
    }

    public function setIdClase($id_clase)
    {
        $this->id_clase = $id_clase;
    }

    public function getCancelar()
    {
        return $this->cancelar;
    }

    public function setCancelar($cancelar)
    {
        $this->cancelar = $cancelar;
    }

}