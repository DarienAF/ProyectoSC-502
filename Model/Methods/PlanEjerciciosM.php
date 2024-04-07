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

    public function create(PlanEjercicios $planEjercicio): bool
{
    $retVal = false;

    try {
        $query = "INSERT INTO `plan_ejercicios` (
                  `id_plan`, 
                  `id_ejercicio`, 
                  `series`, 
                  `repeticiones`) VALUES (?, ?, ?, ?)";

        $statement = $this->connection->prepare($query);
        // Vincular valores a los placeholders correspondientes en la sentencia.
        $statement->bindValue(1, $planEjercicio->getIdPlan(), PDO::PARAM_INT);
        $statement->bindValue(2, $planEjercicio->getIdEjercicio(), PDO::PARAM_INT);
        $statement->bindValue(3, $planEjercicio->getSeries(), PDO::PARAM_INT);
        $statement->bindValue(4, $planEjercicio->getRepeticiones(), PDO::PARAM_INT);
        if ($statement->execute()) {
            $retVal = true;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return $retVal;
}

    public function update(PlanEjercicios $planEjercicioActualizado, PlanEjercicios $planEjercicioOriginal): bool
    {
        $updates = [];
        $params = [];

        if ($planEjercicioActualizado->getIdPlan() !== $planEjercicioOriginal->getIdPlan() && !is_null($planEjercicioActualizado->getIdPlan())) {
            $updates[] = "`id_plan` = ?";
            $params[] = $planEjercicioActualizado->getIdPlan();
        }
        if ($planEjercicioActualizado->getIdEjercicio() !== $planEjercicioOriginal->getIdEjercicio() && !is_null($planEjercicioActualizado->getIdEjercicio())) {
            $updates[] = "`id_ejercicio` = ?";
            $params[] = $planEjercicioActualizado->getIdEjercicio();
        }
        if ($planEjercicioActualizado->getSeries() !== $planEjercicioOriginal->getSeries() && !is_null($planEjercicioActualizado->getSeries())) {
            $updates[] = "`series` = ?";
            $params[] = $planEjercicioActualizado->getSeries();
        }
        if ($planEjercicioActualizado->getRepeticiones() !== $planEjercicioOriginal->getRepeticiones() && !is_null($planEjercicioActualizado->getRepeticiones())) {
            $updates[] = "`repeticiones` = ?";
            $params[] = $planEjercicioActualizado->getRepeticiones();
        }

        if (!empty($updates)) {
            $query = "UPDATE `plan_ejercicios` SET " . implode(", ", $updates) . " WHERE `id_plan` = ? AND `id_ejercicio` = ?";
            $params[] = $planEjercicioOriginal->getIdPlan();
            $params[] = $planEjercicioOriginal->getIdEjercicio();

            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement->rowCount() > 0;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return false;
            }
        }
        return false;
    }

    public function view($id_plan, $id_ejercicio)
    {
        $planEjercicio = null;
        try {
            $query = "SELECT * FROM `plan_ejercicios` WHERE `id_plan` = ? AND `id_ejercicio` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_plan, PDO::PARAM_INT);
            $statement->bindValue(2, $id_ejercicio, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $planEjercicio = new PlanEjercicios();
                $planEjercicio -> setExcercisePlansFields($row);
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
            $planEjercicio-> setExcercisePlansFields($row);
            $planesEjercicios[] = $planEjercicio;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $planesEjercicios;
    }

    public function delete($id_plan, $id_ejercicio)
    {
        $success = false;
        try {
            $query = "DELETE FROM `plan_ejercicios` WHERE `id_plan` = ? AND `id_ejercicio` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_plan, PDO::PARAM_INT);
            $statement->bindValue(2, $id_ejercicio, PDO::PARAM_INT);
    
            $success = $statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    
        return $success;
    }
    
}