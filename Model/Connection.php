<?php

class Connection
{
    private $mysqli;
    private $host= 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'ProyectoSC-502';


    private function createConnection() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->mysqli->connect_error) {
            die('Error en conexion (' . $this->mysqli->connect_errno . ')' . $this->mysqli->connect_error);
        }
    }

    function Connect() {
        if ($this->mysqli == null) {
            $this->createConnection();
        }
        return $this->mysqli;
    }

    function Prepare($query) {
        if (!$this->mysqli) {
            $this->Connect();
        }
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            die('Error en preparación de la consulta: ' . $this->mysqli->error);
        }
        return $stmt;
    }

    function Query($query) {
        if (!$this->mysqli) {
            $this->Connect();
        }
        $this->mysqli->autocommit(TRUE);
        $resultado = $this->mysqli->query($query);
        if (!$resultado) {
            die('Error en la ejecución de la consulta: ' . $this->mysqli->error);
        }
        return $resultado;
    }

    function Close() {
        if ($this->mysqli != null) {
            $this->mysqli->close();
            $this->mysqli = null;
        }
    }
}

