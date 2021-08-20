<?php

namespace app\db;

use app\manager\Application;
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
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $password;

    /**
     * @var PDO
     */
    private static $conn;

    /**
     * @var self
     */
    private static $instance;

    private function __construct(string $host, string $database, string $user, string $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;

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
            try {
                $dsn = "mysql:host=$this->host;dbname=$this->database";

                self::$conn = new PDO($dsn, $this->user, $this->password);

                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $th) {
                echo $th->getMessage();
                exit();
            }
        }

        return self::$conn;
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            $config = Application::getConfig();
            $host = $config['db']['host'];
            $database = $config['db']['database'];
            $user = $config['db']['user'];
            $password = $config['db']['password'];

            self::$instance = new self($host, $database, $user, $password);
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
