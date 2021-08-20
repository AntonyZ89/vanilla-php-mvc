<?php

namespace app\db;

use Exception;
use PDO;

class Database
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $database;

    /**
     * @var PDO
     */
    private static $conn;

    /**
     * @var self
     */
    private static $instance;

    private function __construct(string $host, string $database)
    {
        $this->host = $host;
        $this->database = $database;

        $this->getDb();
    }

    // avoid clone
    private function __clone()
    {
    }

    // avoid serialize
    private function __wakeup()
    {
    }

    public function getDb(): PDO
    {
        if (!self::$conn) {
            // TODO load database from config/main

            try {
                $dsn = "mysql:host=$this->host;dbname=$this->database";
                $user = 'root';
                $password = '';

                self::$conn = new PDO($dsn, $user, $password);

                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $th) {
                // TODO throw message error on error screen :)

                echo $th->getMessage();

                exit();
            }
        }

        return self::$conn;
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self('localhost', 'debt');
        }

        return self::$instance;
    }

    private function setParams($statement, $parameters = array()): void
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value): void
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = self::$conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $r = $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = []): array
    {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
