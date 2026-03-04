<?php 
    namespace App\Core;

use Exception;
use PDO;
use PDOException;

    

    class Database {

        private $connection = null;

        public function connect(){
            $host     = 'localhost';
            $dbname   = 'mvc';
            $username = 'root';
            $password = '';
            $charset  = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try{
            $this->connection = new PDO($dsn, $username, $password, $options);
            return true;
            }catch(PDOException $e){
                throw new Exception('Erro de conexão DB: ' . $e->getMessage());
            }
            return false;
        }

            public function query($sql, $params = []){
                if(!$this->connection){
                    $this->connect();
                }
                try {
                    $stmt = $this->connection->prepare($sql);
                    $stmt->execute($params);
                    return $stmt;
                } catch (PDOException $e){
                    throw new Exception('Erro de consulta DB: ' . $e->getMessage());
                }
            }
        }