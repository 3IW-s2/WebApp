<?php
namespace App\Core;
use App\Core\Configuration\DatabaseConfiguration;
use PDO;
use PDOStatement;
class Database {
    
        private static $instance = null;
        private $pdo;
    
        protected function __construct()
        {
            $configuration = DatabaseConfiguration::getDatabaseConfig();

            $dsn = $configuration["DB_DRIVER"].":host=".$configuration["DB_HOST"].";port=".$configuration["DB_PORT"].";dbname=".$configuration["DB_NAME"].";";

            $this->pdo = new PDO($dsn,
                $configuration["DB_USERNAME"],
                $configuration["DB_PASSWORD"]
            );
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