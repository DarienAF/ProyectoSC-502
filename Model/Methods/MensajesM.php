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

    function Create(Mensajes $mensajes)
    {
        $retVal = false;

        try {
            $query = "INSERT INTO Mensajes (
                      nombreM, 
                      correo, 
                      titulo, 
                      contexto,  
                      leido) VALUES (?, ?, ?, ?, ?)";

            $statement = $this->connection->Prepare($query);

            $nombrem = $mensajes->getNombreM();
            $correo = $mensajes->getCorreo();
            $titulo = $mensajes->getTitulo();
            $contexto = $mensajes->getContexto();
            $leido = $mensajes->getLeido();

            $statement->bind_param("sssss", $nombrem, $correo, $titulo, $contexto, $leido);

            if ($statement->execute()) {
                $retVal = true;
            }

            $statement->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $retVal = false;
        }

        return $retVal;
    }


}