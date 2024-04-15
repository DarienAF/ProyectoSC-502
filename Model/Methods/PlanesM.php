<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Planes;

class PlanesM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function create(Planes $plan): bool
    {
        $retVal = false;

        try {
            $query = "INSERT INTO `planes` (
                      `id_usuario`, 
                      `nombre_plan`,
                      `dia`) VALUES (?, ?, ?)";

            $statement = $this->connection->prepare($query);
            // Vincular valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $plan->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(2, $plan->getNombrePlan(), PDO::PARAM_STR);
            $statement->bindValue(3, $plan->getDia(), PDO::PARAM_STR); 
            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $retVal;
    }

    public function update(Planes $planActualizado, Planes $planOriginal): bool
    {
    $updates = [];
    $params = [];

    if ($planActualizado->getIdUsuario() !== $planOriginal->getIdUsuario() && !is_null($planActualizado->getIdUsuario())) {
        $updates[] = "`id_usuario` = ?";
        $params[] = $planActualizado->getIdUsuario();
    }
    if ($planActualizado->getNombrePlan() !== $planOriginal->getNombrePlan() && !is_null($planActualizado->getNombrePlan())) {
        $updates[] = "`nombre_plan` = ?";
        $params[] = $planActualizado->getNombrePlan();
    }
    if ($planActualizado->getDia() !== $planOriginal->getDia() && !is_null($planActualizado->getDia())) {
        $updates[] = "`dia` = ?";
        $params[] = $planActualizado->getDia();
    }

    if (!empty($updates)) {
        $query = "UPDATE `planes` SET " . implode(", ", $updates) . " WHERE `id_plan` = ?";
        $params[] = $planActualizado->getIdPlan();

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


    public function view($id_plan)
    {
        $plan = null;
        try {
            $query = "SELECT * FROM `planes` WHERE `id_plan` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_plan, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $plan = new Planes();
                $plan->setPlanesFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $plan;
    }

    public function viewAll(): array
    {
    $planes = [];
    try {
        $query = "SELECT * FROM `planes`";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $plan = new Planes();
            $plan->setPlanesFields($row);
            $planes[] = $plan;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $planes;
    }

    public function delete($id_plan)
    {
    $success = false;
    try {
        $query = "DELETE FROM `planes` WHERE `id_plan` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $id_plan, PDO::PARAM_INT);

        $success = $statement->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return $success;
    }


}