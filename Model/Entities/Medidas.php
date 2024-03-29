<?php

class Medidas {
    private $id_medida;
    private $id_usuario;
    private $fecha_registro;
    private $peso;
    private $altura;
    private $edad;
    private $grasa;
    private $musculo;
    

    public function getIdMedida()
    {
        return $this->id_medida;
    }

    public function setIdMedida($id_medida)
    {
        $this->id_medida = $id_medida;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    public function getGrasa()
    {
        return $this->grasa;
    }

    public function setGrasa($grasa)
    {
        $this->grasa = $grasa;
    }

    public function getMusculo()
    {
        return $this->musculo;
    }

    public function setMusculo($musculo)
    {
        $this->musculo = $musculo;
    }
}
