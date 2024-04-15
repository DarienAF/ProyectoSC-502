<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Reservaciones;

class ReservacionesM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function create(Reservaciones $reserva): bool
    {
        $retVal = false;

        try {
            $query = "INSERT INTO `reservaclases` (`id_usuario`, `id_clase`, `cancelar`) VALUES (?, ?, ?)";
            $statement = $this->connection->prepare($query);

            // Vincular valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $reserva->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(2, $reserva->getIdClase(), PDO::PARAM_INT);
            $statement->bindValue(3, $reserva->getCancelar(), PDO::PARAM_INT);

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $retVal;
    }

    function update(Reservaciones $reservaActualizada, Reservaciones $reservaOriginal): bool
    {
        $updates = [];
        $params = [];

        if ($reservaActualizada->getIdUsuario() !== $reservaOriginal->getIdUsuario() && !is_null($reservaActualizada->getIdUsuario())) {
            $updates[] = "`id_usuario` = ?";
            $params[] = $reservaActualizada->getIdUsuario();
        }
        if ($reservaActualizada->getIdClase() !== $reservaOriginal->getIdClase() && !is_null($reservaActualizada->getIdClase())) {
            $updates[] = "`id_clase` = ?";
            $params[] = $reservaActualizada->getIdClase();
        }
        if ($reservaActualizada->getCancelar() !== $reservaOriginal->getCancelar() && !is_null($reservaActualizada->getCancelar())) {
            $updates[] = "`cancelar` = ?";
            $params[] = $reservaActualizada->getCancelar();
        }

        if (!empty($updates)) {
            $query = "UPDATE `reservaclases` SET " . implode(", ", $updates) . " WHERE `id_reserva` = ?";
            $params[] = $reservaActualizada->getIdReserva();

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

    function view($id_reserva)
    {
        $reserva = null;
        try {
            $query = "SELECT * FROM `reservaclases` WHERE `id_reserva` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_reserva, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $reserva = new Reservaciones();
                $reserva->setReservacionesFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $reserva;
    }

    function viewAll(): array
    {
        $reservaciones = [];
        try {
            $query = "SELECT * FROM `reservaclases`";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $reserva = new Reservaciones();
                $reserva->setReservacionesFields($row);
                $reservaciones[] = $reserva;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $reservaciones;
    }

    function delete($id_reserva)
    {
        $success = false;
        try {
            $query = "DELETE FROM `reservaclases` WHERE `id_reserva` = ?";
            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_reserva, PDO::PARAM_INT);

            $success = $statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $success;
    }

    function setCancelStatus($id_reserva, $status): bool
    {
        $retVal = false;

        try {
            $query = "UPDATE `reservaclases` SET `cancelar` = ? WHERE `id_reserva` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $status, PDO::PARAM_BOOL);
            $statement->bindValue(2, $id_reserva, PDO::PARAM_INT);

            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $retVal;
    }

    public function traerClasesAsistidas(){
       
        $query = "SELECT Clases.nombre_clase, COUNT(*) 
        AS conteo
        FROM ReservaClases
        JOIN Clases ON ReservaClases.id_clase = Clases.id_clase
        WHERE ReservaClases.cancelar = FALSE
        GROUP BY Clases.nombre_clase
        ORDER BY conteo DESC";

        try {
            $resultado = $this->connection->Prepare($query); 
            $resultado->execute();

            $arr = array(); 
            
            foreach($resultado->fetchAll() as $encontrado){
                $clase = array("nombre_clase" => $encontrado['nombre_clase'],
                 "conteo" => $encontrado['conteo']);
                $arr[] = $clase;
            }
            return $arr;
    
        } catch (PDOException $Exception) {
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );
            return json_encode($error);
        }
    }

    public function traerClasesCanceladas(){
        
        $query = "SELECT Clases.nombre_clase, COUNT(*) 
        AS cancelaciones        
        FROM ReservaClases
        JOIN Clases 
        ON ReservaClases.id_clase = Clases.id_clase
        WHERE cancelar = TRUE
        GROUP BY Clases.nombre_clase";

        $arr = array();  
    
        try {
            $resultado = $this->connection->Prepare($query); 
            $resultado->execute();
            $arr = array(); 
            
            foreach($resultado->fetchAll() as $encontrado){
                $clase = array("nombre_clase" => $encontrado['nombre_clase'],
                 "cancelaciones" => $encontrado['cancelaciones']);
                $arr[] = $clase;
            }
        
            return $arr;
    
        } catch (PDOException $Exception) {
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );
            return json_encode($error);
        }
    }

    
    


}