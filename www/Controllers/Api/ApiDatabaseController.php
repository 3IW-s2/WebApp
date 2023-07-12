<?php
namespace App\Controllers\Api;


use App\Controllers\Installer;
use App\Core\Configuration\Configuration;
use App\Core\Configuration\DatabaseConfiguration;
use App\Core\Database;

class ApiDatabaseController extends Api{

    private $database;

    public function __construct()
    {
        parent::__construct();
        try{
            $this->database = Database::getInstance();
        }catch (\Exception $e){
            $this->database = null;
        }
    }

    public function initialize()
    {
        $sql = DatabaseConfiguration::getInitFile();
        try{
            $checkTableExistence = $this->database->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name;");
            $checkTableExistence = $checkTableExistence->fetchAll();
            if(count($checkTableExistence) > 0){
                foreach($checkTableExistence as $table){
                    $this->database->pdo->exec("DROP TABLE public.{$table["table_name"]} CASCADE;");
                }
            }

            $this->database->pdo->exec($sql);
        }catch (\Exception $e){
            if((Configuration::getConfig("DB")["DB_DRIVER"] === "pgsql") && $e->getCode() === "42P07") {
                $this->jsonResponse(['message' => "ERREUR: Une ou plusieurs tables existent déjà", "success" => false], 500);
            }
            $this->jsonResponse(['message' => "Impossible d'initialiser la base de données <br>".$e->getMessage()." <br> Code: ".$e->getCode(), "success" => false], 500);
        }
    }
    public function get(){
        $databaseConfiguration = DatabaseConfiguration::getDatabaseConfig();
        $this->jsonResponse(['configuration' => $databaseConfiguration], 200);
    }

    public function post()
    {
        $data = $_POST;
        if(!isset($data["databaseHost"], $data["databasePort"], $data["databaseName"], $data["databaseUsername"], $data["databasePassword"], $data["databasePrefix"])){
            $this->jsonResponse(['message' => "Données manquantes", "success" => false], 400);
        }

        Configuration::setConfig("DB_HOST", "\"".$data["databaseHost"]."\"");
        Configuration::setConfig("DB_PORT", $data["databasePort"]);
        Configuration::setConfig("DB_NAME", "\"".$data["databaseName"]."\"");
        Configuration::setConfig("DB_USERNAME", "\"".$data["databaseUsername"]."\"");
        Configuration::setConfig("DB_PASSWORD", "\"".$data["databasePassword"]."\"");
        Configuration::setConfig("DB_PREFIX", "\"".$data["databasePrefix"]."\"");

        if($this->database === null){
            try{
                $this->database = Database::getInstance();
            }catch (\Exception $e){
                $this->jsonResponse(['message' => "Impossible de se connecter à la base de données", "success" => false], 500);
            }
        }

        $needInstall = Installer::checkNeedInstall();
        if(!$needInstall["database"]){

            $this->initialize();
            $this->jsonResponse(['message' => "Configuration sauvegardée", "success" => true]);
        }else{
            $this->jsonResponse(['message' => "Impossible de se connecter à la base de données", "success" => false], 500);
        }
    }

    public function put()
    {
        $this->jsonResponse(['message' => 'PUT Method not implemented'], 405);
    }

    public function delete()
    {
        $this->jsonResponse(['message' => 'DELETE Method not implemented'], 405);
    }
}