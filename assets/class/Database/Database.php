<?php
declare(strict_types=1);
namespace Database;


/**
 * Class Database
 * @package Database
 */
abstract class Database
{

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $database;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;


    /**
     * @var bool
     */
    protected $inTransaction;

    /**
     * @var mixed
     */
    protected $connection;

    /**
     * @param string $host
     */
    abstract public function setHost(string $host) : void;

    /**
     * @param string $database
     */
    abstract public function setDatabase(string $database) : void;

    /**
     * @param string $username
     */
    abstract public function setUsername(string $username) : void;

    /**
     * @param string $password
     */
    abstract public function setPassword(string $password) : void;

    /**
     *
     */
    abstract protected function connect() : void;

    /**
     *
     */
    abstract public function beginTransaction() : void;

    /**
     *
     */
    abstract public function commitTransaction() : void;

    /**
     *
     */
    abstract public function rollbackTransaction() : void;

    /**
     * @return bool
     */
    abstract public function inTransaction() : bool;

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    abstract public function queryDatabase(string $sql, array $params) : array;

    /**
     * @return array
     */
    abstract public function getLastError(): array;

    /**
     * @param string $error
     * @param string $database
     */
    abstract public function logError(string $error, string $database): void;

    /**
     *
     */
    abstract public function disconnect(): void;

}