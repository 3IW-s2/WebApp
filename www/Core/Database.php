<?php
namespace App\Core;
use PDO;
use PDOStatement;
class Database {
    
        private static $instance = null;
        private $pdo;
        private $configuration;
    
        protected function __construct()
        {
            $this->pdo = new PDO("pgsql:host=database_tiw;port=5432;dbname=database_tiw;", "postgres", "postgres");
//            $this->pdo = new PDO("pgsql:host=gavinaperano.com;port=5432;dbname=database_tiw;", "postgres", "postgres");
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
            try {
                $statement->execute($params);
            } catch (Exception $e)
            {
                return $e->getMessage();
            }
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