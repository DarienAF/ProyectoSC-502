<?php

namespace ProyectoSC502\Model\Entities;

class Ejercicios
{
        private $id_ejercicio;
        private $nombre_ejercicio;
        private $grupo_muscular;
        private $imagen_ejercicio;
    
        public function getIdEjercicio()
        {
            return $this->id_ejercicio;
        }
    
        public function setIdEjercicio($id_ejercicio)
        {
            $this->id_ejercicio = $id_ejercicio;
        }
    
        public function getNombreEjercicio()
        {
            return $this->nombre_ejercicio;
        }
    
        public function setNombreEjercicio($nombre_ejercicio)
        {
            $this->nombre_ejercicio = $nombre_ejercicio;
        }
    
        public function getGrupoMuscular()
        {
            return $this->grupo_muscular;
        }
    
        public function setGrupoMuscular($grupo_muscular)
        {
            $this->grupo_muscular = $grupo_muscular;
        }
    
        public function getImagenEjercicio()
        {
            return $this->imagen_ejercicio;
        }
    
        public function setImagenEjercicio($imagen_ejercicio)
        {
            $this->imagen_ejercicio = $imagen_ejercicio;
        }
    
        public function setEjerciciosFields($row)
        {
            $this->setIdEjercicio($row['id_ejercicio']);
            $this->setNombreEjercicio($row['nombre_ejercicio']);
            $this->setGrupoMuscular($row['grupo_muscular']);
            $this->setImagenEjercicio($row['imagen_ejercicio']);
        }
    
        public function toArray()
        {
            return [
                'id_ejercicio' => $this->getIdEjercicio(),
                'nombre_ejercicio' => $this->getNombreEjercicio(),
                'grupo_muscular' => $this->getGrupoMuscular(),
                'imagen_ejercicio' => $this->getImagenEjercicio()
            ];
        }

    }