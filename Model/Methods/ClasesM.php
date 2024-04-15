<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Clases;

class ClasesM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function create(Clases $clase): bool
    {
    $retVal = false;

    try {
        $query = "INSERT INTO `clases` (
                  `id_usuario`, 
                  `hora_inicio`, 
                  `hora_fin`, 
                  `dia`, 
                  `nombre_clase`,
                  `id_categoria`) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->connection->Prepare($query);
        // Vincular  valores a los placeholders correspondientes en la sentencia.
        $statement->bindValue(1, $clase->getIdUsuario(), PDO::PARAM_INT); //int
        $statement->bindValue(2, $clase->getHoraInicio(), PDO::PARAM_STR);
        $statement->bindValue(3, $clase->getHoraFin(), PDO::PARAM_STR);
        $statement->bindValue(4, $clase->getDia(), PDO::PARAM_STR);
        $statement->bindValue(5, $clase->getNombreClase(), PDO::PARAM_STR);
        $statement->bindValue(6, $clase->getIdCategoria(), PDO::PARAM_INT); //int

        if ($statement->execute()) {
            $retVal = true;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return $retVal;
    }


    function update(Clases $claseActualizada, Clases $claseOriginal): bool
    {
    $updates = [];
    $params = [];

    if ($claseActualizada->getIdUsuario() !== $claseOriginal->getIdUsuario() && !is_null($claseActualizada->getIdUsuario())) {
        $updates[] = "`id_usuario` = ?";
        $params[] = $claseActualizada->getIdUsuario();
    }
    if ($claseActualizada->getHoraInicio() !== $claseOriginal->getHoraInicio() && !is_null($claseActualizada->getHoraInicio())) {
        $updates[] = "`hora_inicio` = ?";
        $params[] = $claseActualizada->getHoraInicio();
    }
    if ($claseActualizada->getHoraFin() !== $claseOriginal->getHoraFin() && !is_null($claseActualizada->getHoraFin())) {
        $updates[] = "`hora_fin` = ?";
        $params[] = $claseActualizada->getHoraFin();
    }
    if ($claseActualizada->getDia() !== $claseOriginal->getDia() && !is_null($claseActualizada->getDia())) {
        $updates[] = "`dia` = ?";
        $params[] = $claseActualizada->getDia();
    }
    if ($claseActualizada->getNombreClase() !== $claseOriginal->getNombreClase() && !is_null($claseActualizada->getNombreClase())) {
        $updates[] = "`nombre_clase` = ?";
        $params[] = $claseActualizada->getNombreClase();
    }
    if ($claseActualizada->getIdCategoria() !== $claseOriginal->getIdCategoria() && !is_null($claseActualizada->getIdCategoria())) {
        $updates[] = "`id_categoria` = ?";
        $params[] = $claseActualizada->getIdCategoria();
    }

    if (!empty($updates)) {
        $query = "UPDATE `clases` SET " . implode(", ", $updates) . " WHERE `id_clase` = ?";
        $params[] = $claseActualizada->getIdClase();

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


    function view($id_clase)
    {
        $clase = null;
        try {
            $query = "SELECT * FROM `clases` WHERE `id_clase` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_clase, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $clase = new Clases();
                $clase->setClassFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $clase;
    }

    function viewAll(): array
    {
        $clases = [];
        try {
            $query = "SELECT * FROM `clases`";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $clase = new Clases();
                $clase->setClassFields($row);
                $clases[] = $clase;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $clases;
    }

    function delete($id_clase)
    {
        $success = false;
        try {
            $query = "DELETE FROM `clases` WHERE `id_clase` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_clase, PDO::PARAM_INT);

            $success = $statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $success;
    }



}