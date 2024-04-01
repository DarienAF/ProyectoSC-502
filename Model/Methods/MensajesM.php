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
}
