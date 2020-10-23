<?php


namespace App\Core;

/**
 * Class DbModel
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
abstract class DbModel extends Model
{
    /**
     * Table name
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * Model attributes
     * @return array
     */
    abstract public function attributes(): array;

    /**
     * insert records
     * @return string
     */
    public function insert()
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();

            return self::lastInsertId();
        } catch (\PDOException $e) {
            $this->errors["errors"][] = $e->getMessage();
            Application::$app->response->setStatusCode(400);
            Application::$app->response->response(400, 'error', $this->errors);
        }
    }

    /**
     * Get list by the condition
     * @param array $where
     * @return array
     */
    public function find(array $where = [])
    {
        try {
            $sql = "";
            $tableName = static::tableName();
            $attributes = array_keys($where);
            if (!empty($where)) {
                $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
                $sql = " WHERE $sql";
            }
            $statement = self::prepare("SELECT * FROM $tableName" . $sql);
            foreach ($where as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();

            return $statement->fetchAll();
        } catch (\PDOException $e) {
            $this->errors["errors"][] = $e->getMessage();
            Application::$app->response->setStatusCode(400);
            Application::$app->response->response(400, 'error', $this->errors);
        }
    }

    /**
     * Get findOne by the condition
     * @param array $where
     * @return mixed
     */
    public function findOne(array $where)
    {
        try {
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();

            return $statement->fetchObject(static::class);
        } catch (\PDOException $e) {
            $this->errors["errors"][] = $e->getMessage();
            Application::$app->response->setStatusCode(400);
            Application::$app->response->response(400, 'error', $this->errors);
        }
    }

    /**
     * pdo preapre function
     * @param $sql
     * @return bool|\PDOStatement
     */
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    /**
     * Get last insert id
     * @return string
     */
    public static function lastInsertId()
    {
        return Application::$app->db->pdo->lastInsertId();
    }
}