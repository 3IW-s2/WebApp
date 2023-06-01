<?php

namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use App\Core\Database;
use PDO;
use App\Core\Mail;
use App\Repositories\UserRepository;
use Exception;

class Comment extends Database
{
    private Int $id = 0;
    private String $comment;
    private Int $status = 0;
    private \DateTime $date_inserted;
    private \DateTime $date_updated;
    private $baseUrl;
    private $error;

    public function __construct( Error $error){
        $this->date_inserted = new \DateTime();
        $this->date_updated = new \DateTime();
        $this->error = $error;
        $this->loadConfig();

    }

    private function loadConfig() {
        $configFile = __DIR__ . '/../config.yml';
        $config = yaml_parse_file($configFile);

        $this->baseUrl = $config['base_url'];
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
