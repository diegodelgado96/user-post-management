<?php

namespace App\Database;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $connection;

    public function __construct()
    {
        // Cargar las variables de entorno desde el archivo .env
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();

        $this->host = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
    }

    public function connect()
    {
        if ($this->connection) {
            return $this->connection;
        }

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
