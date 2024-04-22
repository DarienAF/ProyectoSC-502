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

    public function traerClasesAsistidas()
    {
        $query = "SELECT Clases.nombre_clase, COUNT(*) 
        AS conteo
        FROM ReservaClases
        JOIN Clases ON ReservaClases.id_clase = Clases.id_clase
        WHERE ReservaClases.cancelar = TRUE
        GROUP BY Clases.nombre_clase
        ORDER BY conteo DESC
        LIMIT 5";
    
        try {
            $resultado = $this->connection->Prepare($query);
            $resultado->execute();

            $arr = array();

            foreach ($resultado->fetchAll() as $encontrado) {
                $clase = array(
                    "nombre_clase" => $encontrado['nombre_clase'],
                    "conteo" => $encontrado['conteo']
                );
                $arr[] = $clase;
            }
            return $arr;

        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function traerCategoriasAsistidas()
    {
        $query = "SELECT Categoria.nombre_categoria, COUNT(*) AS cantidad_asistentes
            FROM ReservaClases
            JOIN Clases ON ReservaClases.id_clase = Clases.id_clase
            JOIN Categoria ON Clases.id_categoria = Categoria.id_categoria
            WHERE ReservaClases.cancelar = TRUE
            GROUP BY Categoria.nombre_categoria
            ORDER BY cantidad_asistentes DESC";
    
        try {
            $resultado = $this->connection->prepare($query);
            $resultado->execute();
    
            $arr = array();
    
            foreach ($resultado->fetchAll() as $encontrado) {
                $categoria = array(
                    "nombre_categoria" => $encontrado['nombre_categoria'],
                    "cantidad_asistentes" => $encontrado['cantidad_asistentes']
                );
                $arr[] = $categoria;
            }
            return $arr;
    
        } catch (PDOException $Exception) {
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
    

    public function viewReservesbyUser($id_usuario)
    {
        $reservas = [];
        try {
            $query = "
                SELECT rc.id_reserva,
                       u_reservado.username AS nombre_usuario_reservado,
                       u_imparte.username AS username_profesor,
                       u_imparte.nombre AS nombre_usuario_profesor,
                       u_imparte.apellidos AS apellidos_usuario_profesor,
                       c.hora_inicio,
                       c.hora_fin,
                       c.dia,
                       c.nombre_clase,
                       cat.nombre_categoria
                FROM ReservaClases rc
                JOIN Usuarios u_reservado ON rc.id_usuario = u_reservado.id_usuario
                JOIN Clases c ON rc.id_clase = c.id_clase
                JOIN Categoria cat ON c.id_categoria = cat.id_categoria
                JOIN Usuarios u_imparte ON c.id_usuario = u_imparte.id_usuario
                WHERE u_reservado.id_usuario = ? AND rc.cancelar = 1
            ";

            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $reserva = [
                    'id_reserva' => $row['id_reserva'],
                    'nombre_usuario_reservado' => $row['nombre_usuario_reservado'],
                    'username_profesor' => $row['username_profesor'],
                    'nombre_usuario_profesor' => $row['nombre_usuario_profesor'],
                    'apellidos_usuario_profesor' => $row['apellidos_usuario_profesor'],
                    'hora_inicio' => $row['hora_inicio'],
                    'hora_fin' => $row['hora_fin'],
                    'dia' => $row['dia'],
                    'nombre_clase' => $row['nombre_clase'],
                    'nombre_categoria' => $row['nombre_categoria']
                ];

                $reservas[] = $reserva;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $reservas;
    }

    }

    

