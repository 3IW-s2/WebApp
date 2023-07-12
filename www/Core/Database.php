<?php
namespace App\Core;
use App\Core\Configuration\DatabaseConfiguration;
use Exception;
use PDO;
use PDOStatement;
use RuntimeException;

class Database {
    
        private static $instance = null;
        public $pdo;
    
        protected function __construct()
        {
            $configuration = DatabaseConfiguration::getDatabaseConfig();

            try{
                if(!isset($configuration["DB_DRIVER"], $configuration["DB_HOST"], $configuration["DB_PORT"], $configuration["DB_NAME"], $configuration["DB_USERNAME"], $configuration["DB_PASSWORD"])){
                    throw new RuntimeException("Database configuration is not set");
                }

                $dsn = $configuration["DB_DRIVER"].":host=".$configuration["DB_HOST"].";port=".$configuration["DB_PORT"].";dbname=".$configuration["DB_NAME"].";";

                $this->pdo = new PDO($dsn,
                    $configuration["DB_USERNAME"],
                    $configuration["DB_PASSWORD"]
                );
            }catch (Exception $e) {
                throw new RuntimeException("Database connection error: ".$e->getMessage());
            }

        }
    
        public static function getInstance(): Database
        {
            if(is_null(self::$instance)){
                self::$instance = new Database();
            }
            return self::$instance;
        }
    
        public function query(String $query, array $params = [])
        {
            $statement = $this->pdo->prepare($query);
            try {
                $statement->execute($params);
            } catch (Exception $e)
            {
                throw new RuntimeException("Database query error: ".$e->getMessage());
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