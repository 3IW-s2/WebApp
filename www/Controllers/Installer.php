<?php

namespace App\Controllers;

use App\Core\Configuration\DatabaseConfiguration;

class Installer
{
    private array $databaseConfiguration;

    public function __construct(){
        $this->databaseConfiguration = DatabaseConfiguration::getDatabaseConfig();
    }

    public function install()
    {
        echo "<pre>";
        var_dump($this->databaseConfiguration);
        echo "</pre>";
        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/Installer/www/index.html");
    }
}