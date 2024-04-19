<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\PlanEjercicios;

class PlanEjerciciosM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function create(PlanEjercicios $planEjercicio): int
    {
        $lastInsertId = 0;

        try {
            $query = "INSERT INTO `plan_ejercicios` (
                  `id_ejercicio`, 
                  `series`, 
                  `repeticiones`) VALUES (?, ?, ?)";

            $statement = $this->connection->prepare($query);
            // Vincular valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $planEjercicio->getIdEjercicio(), PDO::PARAM_INT);
            $statement->bindValue(2, $planEjercicio->getSeries(), PDO::PARAM_INT);
            $statement->bindValue(3, $planEjercicio->getRepeticiones(), PDO::PARAM_INT);

            if ($statement->execute()) {
                // Obtener el último ID insertado.
                $lastInsertId = $this->connection->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $lastInsertId; // Retorna el último ID insertado o 0 si hubo un fallo
    }

    public function view($id_plan_ejercicio)
    {
        $planEjercicio = null;
        try {
            $query = "SELECT * FROM `plan_ejercicios` WHERE id_plan_ejercicio  = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_plan_ejercicio, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $planEjercicio = new PlanEjercicios();
                $planEjercicio -> setPlanEjerciciosFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $planEjercicio;
    }

    public function viewAll(): array
    {
    $planesEjercicios = [];
    try {
        $query = "SELECT * FROM `plan_ejercicios`";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $planEjercicio = new PlanEjercicios();
            $planEjercicio-> setPlanEjerciciosFields($row);
            $planesEjercicios[] = $planEjercicio;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $planesEjercicios;
    }

    public function delete($id_plan_ejercicio)
    {
        $success = false;
        try {
            $query = "DELETE FROM `plan_ejercicios` WHERE `id_plan_ejercicio` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_plan_ejercicio, PDO::PARAM_INT);
    
            $success = $statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    
        return $success;
    }
    
}