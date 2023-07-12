<?php

namespace App\Controllers;

use App\Core\Configuration\Configuration;
use App\Core\Configuration\DatabaseConfiguration;
use App\Core\Database;
use App\Repositories\UserRepository;
use PHPMailer\PHPMailer\Exception;

class Installer extends Database
{
    private array $databaseConfiguration;

    public function __construct(){
        $this->databaseConfiguration = DatabaseConfiguration::getDatabaseConfig();
    }

    public function install()
    {
        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/Installer/www/index.html");
    }

    public static function checkNeedInstall(): array
    {
        $errors = [
            "database" => false,
            "users" => false,
            "installer_mode" => Configuration::getConfig("INSTALLER")["INSTALLER_MODE"] ?? false
        ];
        try{
            new Database();
        }catch (\Exception $e){
            $errors["database"] = true;
        }

        if(!$errors["database"]){
            try{
                $userRepository = new UserRepository();
                $users = $userRepository->findAll();
                if (empty($users)) {
                    $errors["users"] = true;
                }
            }catch (\Throwable $e) {
                $errors["users"] = true;
            }
        }

        return $errors;

    }
}