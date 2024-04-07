<?php

namespace ProyectoSC502\Model\Entities;

class Categorias
{
    private $id_categoria;
    private $nombre_categoria;
    private $imagen_categoria;

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getNombreCategoria()
    {
        return $this->nombre_categoria;
    }

    public function setNombreCategoria($nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;
    }

    public function getImagenCategoria()
    {
        return $this->imagen_categoria;
    }

    public function setImagenCategoria($imagen_categoria)
    {
        $this->imagen_categoria = $imagen_categoria;
    }

    public function setCategoryFields($row)
    {
        $this->setIdCategoria($row['id_categoria']);
        $this->setNombreCategoria($row['nombre_categoria']);
        $this->setImagenCategoria($row['imagen_categoria']);
    }

    public function toArray()
    {
        return [
            'id' => $this->getIdCategoria(),
            'nombre' => $this->getNombreCategoria(),
            'imagen' => $this->getImagenCategoria()
        ];
    }
    
}
