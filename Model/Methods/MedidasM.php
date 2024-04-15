<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Medidas;

class MedidasM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function create(Medidas $medida): bool
    {
        $retVal = false;

        try {
            $query = "INSERT INTO `medidas` (
                      `id_usuario`, 
                      `fecha_registro`, 
                      `peso`, 
                      `altura`, 
                      `edad`, 
                      `grasa`, 
                      `musculo`) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $statement = $this->connection->Prepare($query);
            // Vincular  valores a los placeholders correspondientes en la sentencia.
            $statement->bindValue(1, $medida->getIdUsuario(), PDO::PARAM_INT); //int
            $statement->bindValue(2, $medida->getFechaRegistro());
            $statement->bindValue(3, $medida->getPeso(), PDO::PARAM_STR);
            $statement->bindValue(4, $medida->getAltura(), PDO::PARAM_STR);
            $statement->bindValue(5, $medida->getEdad(), PDO::PARAM_INT); //int
            $statement->bindValue(6, $medida->getGrasa(), PDO::PARAM_STR);
            $statement->bindValue(7, $medida->getMusculo(), PDO::PARAM_STR);
            if ($statement->execute()) {
                $retVal = true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $retVal;
    }

    function update(Medidas $medidaActualizada, Medidas $medidaOriginal): bool
    {
        $updates = [];
        $params = [];

        if ($medidaActualizada->getIdUsuario() !== $medidaOriginal->getIdUsuario() && !is_null($medidaActualizada->getIdUsuario())) {
            $updates[] = "`id_usuario` = ?";
            $params[] = $medidaActualizada->getIdUsuario();
        }
        if ($medidaActualizada->getFechaRegistro() !== $medidaOriginal->getFechaRegistro() && !is_null($medidaActualizada->getFechaRegistro())) {
            $updates[] = "`fecha_registro` = ?";
            $params[] = $medidaActualizada->getFechaRegistro();
        }
        if ($medidaActualizada->getPeso() !== $medidaOriginal->getPeso() && !is_null($medidaActualizada->getPeso())) {
            $updates[] = "`peso` = ?";
            $params[] = $medidaActualizada->getPeso();
        }
        if ($medidaActualizada->getAltura() !== $medidaOriginal->getAltura() && !is_null($medidaActualizada->getAltura())) {
            $updates[] = "`altura` = ?";
            $params[] = $medidaActualizada->getAltura();
        }
        if ($medidaActualizada->getEdad() !== $medidaOriginal->getEdad() && !is_null($medidaActualizada->getEdad())) {
            $updates[] = "`edad` = ?";
            $params[] = $medidaActualizada->getEdad();
        }
        if ($medidaActualizada->getGrasa() !== $medidaOriginal->getGrasa() && !is_null($medidaActualizada->getGrasa())) {
            $updates[] = "`grasa` = ?";
            $params[] = $medidaActualizada->getGrasa();
        }
        if ($medidaActualizada->getMusculo() !== $medidaOriginal->getMusculo() && !is_null($medidaActualizada->getMusculo())) {
            $updates[] = "`musculo` = ?";
            $params[] = $medidaActualizada->getMusculo();
        }

        if (!empty($updates)) {
            $query = "UPDATE `medidas` SET " . implode(", ", $updates) . " WHERE `id_medida` = ?";
            $params[] = $medidaActualizada->getIdMedida();

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

    function view($id_medida)
    {
        $medida = null;
        try {
            $query = "SELECT * FROM `medidas` WHERE `id_medida` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $id_medida, PDO::PARAM_INT);
            $statement->execute();

            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $medida = new Medidas();
                $medida->setMeasureFields($row);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $medida;
    }

    function viewAll(): array
    {
        $medidas = [];
        try {
            $query = "SELECT * FROM `medidas`";
            $statement = $this->connection->Prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Medidas();
                $usuario->setMeasureFields($row);
                $medidas[] = $usuario;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $medidas;
    }

    function delete($id_medida)
    {
        $success = false;
        try {
            $query = "DELETE FROM `medidas` WHERE `id_medida` = ?";
            $statement = $this->connection->Prepare($query);
            $statement->bindValue(1, $id_medida, PDO::PARAM_INT);

            $success = $statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $success;
    }

    public function traerPromedioPeso(){  
        $query = "SELECT AVG(peso) 
        AS promedio_peso, 
        DATE_FORMAT(fecha_registro, '%Y-%m') 
        AS mes
        FROM Medidas
        WHERE fecha_registro >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)
        GROUP BY mes
        ORDER BY mes ASC";
    
        try {
            $resultado = $this->connection->Prepare($query); 
            $resultado->execute();

            $arr = array(); 

            foreach($resultado->fetchAll() as $encontrado){
                $mes = array("mes" => $encontrado['mes'], 
                "promedio_peso" => $encontrado['promedio_peso']);
                $arr[] = $mes;
            }
        
            return $arr;
    
        } catch (PDOException $Exception) {
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );
            return json_encode($error);
        }
    }
}