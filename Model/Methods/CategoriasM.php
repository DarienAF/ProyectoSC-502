<?php

namespace ProyectoSC502\Model\Methods;

use PDO;
use PDOException;
use ProyectoSC502\Model\Connection;
use ProyectoSC502\Model\Entities\Categorias;

class CategoriasM
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    function view($id_categoria)
    {
    $categoria = null;

    try {
        $query = "SELECT * FROM `categoria` WHERE `id_categoria` = ?";
        $statement = $this->connection->Prepare($query);
        $statement->bindValue(1, $id_categoria, PDO::PARAM_INT);
        $statement->execute();

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categoria = new Categorias();
            $categoria->setCategoryFields($row);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $categoria;
    }

    function viewAll(): array
    {
    $categorias = [];

    try {
        $query = "SELECT * FROM `categoria`";
        $statement = $this->connection->Prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categoria = new Categorias();
            $categoria->setCategoryFields($row);
            $categorias[] = $categoria;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $categorias;
    }

    function viewCategoriesNames(): array
    {
    $categorias = [];

    try {
        $query = "SELECT id_categoria, nombre_categoria FROM `categoria`";
        $statement = $this->connection->Prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categorias[$row['id_categoria']] = $row['nombre_categoria'];
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return $categorias;
    }

    function getCategoryName($id_categoria)
    {
    try {
        $query = "SELECT id_categoria, nombre_categoria FROM `categoria`";
        $statement = $this->connection->Prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if ($row['id_categoria'] == $id_categoria) {
                return $row['nombre_categoria'];
            }
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
    return null;
    }



}