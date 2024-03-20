<?php

class Connection
{
    private static $instance = null;
    private $pdo;
    private $config;

    // Constructor is private to prevent direct instantiation. Initializes the database connection.
    private function __construct()
    {
        $this->config = require 'config.php';
        $this->createConnection();
    }

    // Returns the singleton instance of the Connection class.

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    //Creates a PDO connection using the configuration provided.
    private function createConnection()
    {
        try {
            $dbConfig = $this->config['db'];
            $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'];
            $this->pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Connection error: " . $e->getMessage());
        }
    }

    // Prepares a SQL statement for execution.
    public function Prepare($query)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            if (!$stmt) {
                throw new PDOException('Query preparation error: ' . $this->pdo->errorInfo()[2]);
            }
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException("Preparation error: " . $e->getMessage());
        }
    }

    //Executes a SQL query and returns the result.
    public function Query($query)
    {
        try {
            $result = $this->pdo->query($query);
            if (!$result) {
                throw new PDOException('Query execution error: ' . $this->pdo->errorInfo()[2]);
            }
            return $result;
        } catch (PDOException $e) {
            throw new PDOException("Execution error: " . $e->getMessage());
        }
    }

    // Closes the PDO connection.
    public function Close()
    {
        $this->pdo = null;
    }
}
