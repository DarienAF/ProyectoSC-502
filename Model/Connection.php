<?php

class Connection {
    private static $instance = null;
    private $mysqli;
    private $config;

    // Constructor privado para prevenir la creación de instancias directamente
    private function __construct() {
        $this->config = require 'config.php';
        $this->createConnection();
    }

    // Método para obtener la instancia de la clase
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    // Método para crear una conexión a la base de datos
    private function createConnection() {
        try {
            $dbConfig = $this->config['db'];
            $this->mysqli = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbname']);
            if ($this->mysqli->connect_error) {
                throw new Exception('Error de conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    // Método para preparar una consulta SQL
    public function Prepare($query) {
        try {
            $stmt = $this->mysqli->prepare($query);
            if (!$stmt) {
                throw new Exception('Error en la preparación de la consulta: ' . $this->mysqli->error);
            }
            return $stmt;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    // Método para ejecutar una consulta SQL (simple, parámetros estáticos)
    public function Query($query) {
        try {
            $resultado = $this->mysqli->query($query);
            if (!$resultado) {
                throw new Exception('Error en la ejecución de la consulta: ' . $this->mysqli->error);
            }
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    // Método para cerrar la conexión a la base de datos
    public function Close() {
        if ($this->mysqli != null) {
            $this->mysqli->close();
            $this->mysqli = null;
        }
    }
}