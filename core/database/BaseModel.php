<?php

namespace App\Core\Database;

use PDO;

class BaseModel
{
    protected static $database;
    protected static $table;
    protected static $columns = [];

    /**
     * Set database object.
     *
     * @param PDO $database
     * @return void
     */
    public static function setDatabase(PDO $database)
    {
        self::$database = $database;
    }

    /**
     * Instantiate the given record.
     *
     * @param array $record
     * @return $object
     */
    protected static function instantiate($record)
    {
        $object = new static;

        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }

        return $object;
    }

    /**
     * Run queries using the given $sql and return results.
     *
     * @param string $sql
     * @return $object_array
     */
    public function findBySql($sql)
    {
        $statement = self::$database->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return $results;
        }

        // results into objects
        $object_array = [];

        foreach ($results as $result) {
            $object_array[] = static::instantiate($result);
        }

        return $object_array;
    }

    /**
     * Find all records in the give table.
     *
     * @return $records
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        return $this->findBySql($sql);
    }

    /**
     * Find a record by the given id.
     *
     * @param string $id
     * @return $result
     */
    public function findById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . " WHERE id='{$id}'";
        $result = $this->findBySql($sql);

        if (!empty($result)) {
            return array_shift($result);
        } else {
            return false;
        }
    }

    /**
     * Count all records in the given table.
     *
     * @param  null | string $useId
     * @return number $count
     */
    public static function countAll($userId = null)
    {
        $sql = 'SELECT COUNT(*) FROM ' . static::$table;

        if (isset($userId)) {
            $sql .= " WHERE user_id='{$userId}'";
        }

        $statement = self::$database->prepare($sql);
        $statement->execute();
        $count = $statement->fetch(PDO::FETCH_ASSOC);

        return array_shift($count);
    }

    /**
     * Paginate records from the given table.
     *
     * @param App\Core\Pagination $pagination
     * @param string $userId
     * @return records
     */
    public static function paginate($pagination, $userId = '')
    {
        $sql = 'SELECT * FROM ' . static::$table;

        if ($userId !== '') {
            $sql .= " WHERE user_id='{$userId}'";
        }

        $sql .= " LIMIT  {$pagination->perPage}";
        $sql .= " OFFSET {$pagination->offset()}";

        return self::findBySql($sql);
    }

    /**
     * Store a new record in the database.
     *
     * @return boolean
     */
    public function create()
    {
        $attributes = $this->attributes();
        $placeholders = $this->placeholders($attributes);

        $sql = 'INSERT INTO ' . static::$table . '(';
        $sql .= join(', ', array_keys($attributes));
        $sql .= ') VALUES (';
        $sql .= join(', ', $placeholders);
        $sql .= ')';

        $statement = self::$database->prepare($sql);
        $statement->execute($attributes);

        if ($statement->rowCount() > 0) {
            $this->id = self::$database->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Update the details of the specified record.
     *
     * @return boolean
     */
    public function update()
    {
        $attributes = $this->attributes();
        $attribute_pairs = [];

        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = " {$key} = '{$value}' ";
        }

        $sql = 'UPDATE ' . static::$table . ' SET ';
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='{$this->id}'";
        $sql .= 'LIMIT 1';

        $statement = self::$database->prepare($sql);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check and see which method should be executed.
     *
     * @return method
     */
    public function save()
    {
        if (isset($this->id) && $this->id !== '') {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    /**
     * Remove a record from the table by the given id.
     *
     * @param string $id
     * @return boolean
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . static::$table . " WHERE id='{$id}' LIMIT 1";
        $statement = self::$database->prepare($sql);
        $statement->execute();
        $rowCount = $statement->rowCount();

        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Find and return all attributes.
     *
     * @return array $attributes
     */
    public function attributes()
    {
        $attributes = [];

        foreach (static::$columns as $column) {
            if ($column == 'id') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    /**
     * Create placeholders for all attributes.
     *
     * @param array $attributes
     * @return array $placeholders
     */
    public function placeholders($attributes)
    {
        $placeholders = [];

        foreach (array_keys($attributes) as $attribute) {
            $placeholders[] = ':' . $attribute;
        }

        return $placeholders;
    }
}
