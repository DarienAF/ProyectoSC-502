<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Ejercicios;

class EjerciciosM{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

   
    public function view($id_ejercicio)
    {
        $ejercicio = null;

    try {
        $query = "SELECT * FROM `Ejercicios` WHERE `id_ejercicio` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $id_ejercicio, PDO::PARAM_INT);
        $statement->execute();

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $ejercicio = new Ejercicios();
            $ejercicio->setEjerciciosFields($row);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $ejercicio;
    }

    function viewAll(): array
    {
        $ejercicios = [];

        try {
            $query = "SELECT * FROM `Ejercicios`";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ejercicio = new Ejercicios();
                $ejercicio->setEjerciciosFields($row);
                $ejercicios[] = $ejercicio;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $ejercicios;
    }

    function viewExerciseNames(): array
    {
        $exercises = [];

        try {
            $query = "SELECT id_ejercicio, nombre_ejercicio FROM `Ejercicios`";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $exercises[$row['id_ejercicio']] = $row['nombre_ejercicio'];
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $exercises;
    }

    function getExerciseName($id_ejercicio)
    {
    try {
        $query = "SELECT nombre_ejercicio FROM `Ejercicios` WHERE `id_ejercicio` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $id_ejercicio, PDO::PARAM_INT);
        $statement->execute();

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $row['nombre_ejercicio'];
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return null;
}

}