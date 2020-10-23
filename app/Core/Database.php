<?php


namespace App\Core;

/**
 * Class Database
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Database
{
    /** Class Variables */
    public \PDO $pdo;
    private string $timestamp;

    /**
     * Database constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->timestamp = date('Y-m-d H:i:s');
    }

    /**
     * Prepare func.
     * @param $sql
     * @return bool|\PDOStatement
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}