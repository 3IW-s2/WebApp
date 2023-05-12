<?php
namespace App\Core;
use PDO;
use PDOStatement;
class Database {
    
        private static $instance = null;
        private $pdo;
    
        private function __construct()
        {
            $this->pdo = new PDO("pgsql:host=46.226.107.16;port=5432;dbname=database_tiw;", "postgres", "postgres");
        }
    
        public static function getInstance(): Database
        {
            if(is_null(self::$instance)){
                self::$instance = new Database();
            }
            return self::$instance;
        }
    
        public function query(String $query, array $params = []): PDOStatement
        {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return $statement;
        }
    
        public function lastInsertId(): int
        {
            return $this->pdo->lastInsertId();
        }
    
        public function __destruct()
        {
            $this->pdo = null;
        }

}