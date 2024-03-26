<?php
require_once './Model/Connection.php';
require_once './Model/Entities/Mensajes.php';


class MensajesM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function create(Mensajes $mensajes)
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
            $statement->bindValue(5, $mensajes->getLeido()); //int

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }


}