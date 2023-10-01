<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function getAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getOne($table, $column, $value)
    {
        $statement = $this->pdo->prepare("select * from {$table} where {$column} = {$value}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $flattened = $parameters;
        array_walk($flattened, function(&$value, $key) {
            $value = "{$key} = :{$key}";
        });

        $sql = "INSERT INTO " . $table . " SET " . implode(', ', $flattened);

        try {
            $statement = $this->pdo->prepare($sql);

            foreach ($parameters as $key => $value) {
                $statement->bindParam(":{$key}", $value);
            }

            $statement->execute($parameters);
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($table, $parameters, $column, $val)
    {
        $flattened = $parameters;
        array_walk($flattened, function(&$value, $key) {
            if(isset($value)){
                $value = "{$key} = {$value}";
            }
        });

        $sql = "UPDATE " . $table . " SET " . implode(', ', $flattened) . " WHERE {$column} = {$val}";

        try {
            $statement = $this->pdo->prepare($sql);

            foreach ($parameters as $key => $value) {
                if(isset($value)){
                    $statement->bindParam(":{$key}", $value);
                }
            }

            $statement->execute($parameters);
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($table, $column, $value)
    {
        $sql = "DELETE FROM " . $table . " WHERE {$column} = {$value}";

        $statement = $this->pdo->prepare($sql);

        $statement->bindParam("{$column}", $value);
        try {
            $statement->execute();
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function leftJoin($firstTable, $secondTable, $firstColumn, $secondColumn)
    {
        $sql = "SELECT * FROM {$firstTable} LEFT JOIN {$secondTable} ON {$firstTable}.{$firstColumn} = {$secondTable}.{$secondColumn}";

        $statement = $this->pdo->prepare($sql);

        try {
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}