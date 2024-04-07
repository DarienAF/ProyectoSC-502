<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Mensajes;

class MensajesM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function create(Mensajes $mensajes): bool
    {
        $retVal = false;

        try {
            $query = "INSERT INTO `Mensajes` (
                      `nombreM`, 
                      `correo`, 
                      `titulo`, 
                      `contexto`,  
                      `leido`) VALUES (?, ?, ?, ?, ?)";

            $statement = $this->connection->Prepare($query);

            // Vincular  valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $mensajes->getNombreM());
            $statement->bindValue(2, $mensajes->getCorreo());
            $statement->bindValue(3, $mensajes->getTitulo());
            $statement->bindValue(4, $mensajes->getContexto());
            $statement->bindValue(5, $mensajes->getLeido(), PDO::PARAM_INT); //int

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $retVal;
    }

    function view($id_mensaje)
{
    $mensaje = null;
    try {
        $query = "SELECT * FROM `mensajes` WHERE `id_mensaje` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $id_mensaje, PDO::PARAM_INT);
        $statement->execute();

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $mensaje = new Mensajes();
            $mensaje->setMessageFields($row);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $mensaje;
}

function viewAll(): array
{
    $mensajes = [];
    try {
        $query = "SELECT * FROM `mensajes`";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $mensaje = new Mensajes();
            $mensaje->setMessageFields($row);
            $mensajes[] = $mensaje;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $mensajes;
}

function delete($id_mensaje)
{
    $success = false;
    try {
        $query = "DELETE FROM `mensajes` WHERE `id_mensaje` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $id_mensaje, PDO::PARAM_INT);

        $success = $statement->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return $success;
}

function setReadStatus($id_mensaje, $status): bool
{
    $retVal = false;

    try {
        $query = "UPDATE `mensajes` SET `leido` = ? WHERE `id_mensaje` = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $status, PDO::PARAM_BOOL); 
        $statement->bindValue(2, $id_mensaje, PDO::PARAM_INT);

        if ($statement->execute()) {
            $retVal = true;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $retVal;
}



}
