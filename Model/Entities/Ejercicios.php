<?php
    class Ejercicios {

        private $id_ejercicio;
        private $nombre_ejercicio;
    
        public function getIdEjercicio()
        {
            return $this->id_ejercicio;
        }
    
        public function setIdEjercicio($id_ejercicio)
        {
            $this->id_ejercicio = $id_ejercicio;
        }
    
        public function getNombreEjercico()
        {
            return $this->nombre_ejercicio;
        }
    
        public function setNombreEjercicio($nombre_ejercicio)
        {
            $this->nombre_ejercicio = $nombre_ejercicio;
        }

    }