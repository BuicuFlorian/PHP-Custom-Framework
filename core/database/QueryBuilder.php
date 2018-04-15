<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;

    /**
     * Class constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
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
        $statement = $this->pdo->prepare('SELECT * FROM ' . $table);

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
            'INSERT INTO %s (%s) VALUES (%s)',
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
            'SELECT * FROM %s WHERE %s=\'%s\'',
            $table,
            $key[0],
            $value[0]
        );

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Find a random row in the given table.
     *
     * @param string $table
     * @return array
     */
    public function findRandom($table)
    {
        $sql = 'SELECT * FROM ' . $table . ' ORDER BY RAND() LIMIT 1';

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Find records by the given keyword.
     *
     * @param string $table
     * @param array $parameters
     * @return array
     */
    public function searchByKeyword($table, $parameters)
    {
        $key = array_keys($parameters);
        $value = array_values($parameters);

        $sql = sprintf(
            'SELECT * FROM %s WHERE %s = \'%s\' AND (%s LIKE \'%s\') ORDER BY %s',
            $table,
            $key[0],
            $value[0],
            $key[1],
            $value[1],
            $key[1]
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
            'UPDATE %s SET %s=\'%s\', %s=\'%s\' WHERE %s=%s',
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
            'DELETE FROM %s WHERE id=\'%s\' LIMIT 1',
            $table,
            $id
        );

        $statement = $this->pdo->prepare($sql);

        $statement->execute();
    }
}
