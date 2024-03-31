<?php

namespace ProyectoSC502\Model;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private $pdo;
    private $config;

    private function __construct()
    {
        $this->config = require 'config.php';
        $this->createConnection();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

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

}
