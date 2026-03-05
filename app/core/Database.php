<?php 

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Database {

    private $connection = null;
    private static $instance = null;

    private function __construct(){
        $this->connect();
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connect(){
        $databaseConfig = config('database');

        $host = $databaseConfig['host'];
        $dbname = $databaseConfig['dbname'];
        $charset = $databaseConfig['charset'];
        $username = $databaseConfig['username'];
        $password = $databaseConfig['password'];

        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try{
            $this->connection = new PDO($dsn, $username, $password, $options);
            return true;

        } catch(PDOException $e){
            throw new Exception('Erro de conexão DB: ' . $e->getMessage());
        }
    }

    public function fetch($sql, $params = []): array|null{
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    public function fetchAll($sql, $params = []): array{
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    public function execute($sql, $params = []): int{
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->connection->lastInsertId();
    }

    public function query($sql, $params = []){
        try{
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;

        } catch(PDOException $e){
            throw new Exception('Erro de consulta DB: ' . $e->getMessage());
        }
    }
}