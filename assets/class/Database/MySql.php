<?php
declare(strict_types=1);

namespace Database;

use Exception;
use PDOException;

/**
 * Class MySql
 * @package Database
 */
class MySql extends Database
{

    /** @var  \PDOStatement $lastStatement */
    private $lastStatement;

    /**
     * MySql constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
        $this->inTransaction = false;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param string $database
     */
    public function setDatabase(string $database): void
    {
        $this->database = $database;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
    public function connect(): void
    {
        if(!isset($this->connection)) {
            try {
                $this->connection = new \PDO( "mysql:host={$this->host};charset=utf8mb4", $this->username, $this->password );
                $this->connection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
                $this->connection->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
            } catch(PDOException $ex) {
                throw new Exception("MySql : Unable to connect to database");
            }
        }
    }

    /**
     * @throws Exception
     */
    public function beginTransaction(): void
    {
        if ($this->connection->beginTransaction() === false ){
            throw new Exception("SqlServer : Unable to connect to database");
        }
        $this->inTransaction = true;
    }

    /**
     *
     */
    public function commitTransaction(): void
    {
        $this->connection->commit();
        $this->inTransaction = false;
    }

    /**
     *
     */
    public function rollbackTransaction(): void
    {
        $this->connection->rollBack();
        $this->inTransaction = false;
    }

    /**
     * @return bool
     */
    public function inTransaction(): bool
    {
        return $this->inTransaction;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function queryDatabase(string $sql, array $params = []): array
    {
        $this->lastStatement = $this->connection->prepare($sql);
        $this->lastStatement->execute($params);

        if(!$this->lastStatement){
            throw new Exception("MySql : " . json_encode($this->lastStatement->errorInfo()));
        }

        return $this->lastStatement->rowCount() > 0 ? $this->lastStatement->fetchAll(\PDO::FETCH_ASSOC) : [];
    }

    /**
     * @return array
     */
    public function getLastError(): array
    {
        return $this->lastStatement->errorInfo();
    }

    /**
     * @param string $error
     * @param string $database
     */
    public function logError(string $error, string $database): void
    {
        $stmt = $this->connection->prepare("INSERT INTO " . $database . ".errorlog(dateAdded, error) VALUES(CURRENT_TIMESTAMP, :error)");
        $stmt->execute([":error" => $error]);
    }

    /**
     *
     */
    public function disconnect(): void
    {
        $this->connection = null;
    }

}