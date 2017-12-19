<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;

    /**
     * Class constructor.
     * 
     * @param object $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all rows from a table.
     * 
     * @param  string $table
     * @return array
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert given values into the table.
     * 
     * @param  string $table
     * @param  array $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (Exception $e) {
            die('Whoops, something went wrong!');
        }
    }

    /**
     * Find a row into the given table.
     * 
     * @param  string $table
     * @param  array $parameters
     * @return array 
     */
    public function find($table, $parameters)
    {
        $key = array_keys($parameters);
        $value = array_values($parameters);

        $sql = sprintf(
            "select * from %s where %s='%s'",
            $table,
            $key[0],
            $value[0]
        );

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Update the values of a registration from the given table.
     * 
     * @param  string $table
     * @param  array $parameters
     */
    public function update($table, $parameters)
    {
        $columns = array_keys($parameters);
        $values = array_values($parameters);

        $sql = sprintf(
            "UPDATE %s SET %s='%s', %s='%s' WHERE %s=%s",
            $table,
            $columns[1],
            $values[1],
            $columns[2],
            $values[2],
            $columns[0],
            $values[0]
         );

        $statement = $this->pdo->prepare($sql);

        return $statement->execute();
    }

    /**
     * Delete a row from the given table.
     * 
     * @param  string $table
     * @param  string $id
     */
    public function delete($table, $id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id=%s',
            $table,
            $id
        );

        $statement = $this->pdo->prepare($sql);

        $statement->execute();
    }
}
