<?php

namespace ProyectoSC502\Model\Entities;

class Mensajes
{
    private $id_mensaje;
    private $nombreM;
    private $correo;
    private $titulo;
    private $contexto;
    private $fecha_envio;
    private $leido;

    public function getIdMensaje()
    {
        return $this->id_mensaje;
    }

    public function setIdMensaje($id_mensaje)
    {
        $this->id_mensaje = $id_mensaje;
    }

    public function getNombreM()
    {
        return $this->nombreM;
    }

    public function setNombreM($nombreM)
    {
        $this->nombreM = $nombreM;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getContexto()
    {
        return $this->contexto;
    }

    public function setContexto($contexto)
    {
        $this->contexto = $contexto;
    }

    public function getFechaEnvio()
    {
        return $this->fecha_envio;
    }

    public function setFechaEnvio($fecha_envio)
    {
        $this->fecha_envio = $fecha_envio;
    }

    public function getLeido()
    {
        return $this->leido;
    }

    public function setLeido($leido)
    {
        $this->leido = $leido;
    }


    public function setMessageFields($row)
    {
        $this->setIdMensaje($row['id_mensaje']);
        $this->setNombreM($row['nombreM']);
        $this->setCorreo($row['correo']);
        $this->setTitulo($row['titulo']);
        $this->setContexto($row['contexto']);
        $this->setFechaEnvio($row['fecha_envio']);
        $this->setLeido($row['leido']);
    }

    public function toArray()
    {
        return [
            'id' => $this->getIdMensaje(),
            'nombre' => $this->getNombreM(),
            'correo' => $this->getCorreo(),
            'titulo' => $this->getTitulo(),
            'contexto' => $this->getContexto(),
            'fecha' => $this->getFechaEnvio(),
            'leido' => $this->getLeido(),
        ];
    }
}