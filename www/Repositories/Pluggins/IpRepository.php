<?php 
namespace App\Repositories\Pluggins;

use App\Core\Configuration\DatabaseConfiguration;
use App\Core\Database;
use PDO;


class IpRepository {

    public function __construct()
    {
        $this->table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_".'ip';
        $this->db = Database::getInstance();
    }

    public function getAllIp()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($query);
        $ips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ips;

    }

    public function AddNewIp($ip)
    {
        $query = "INSERT INTO {$this->table} (ip ,created_at) VALUES (:ip , NOW())";
        $params = [
            'ip' => $ip
        ];
        $stmt = $this->db->query($query, $params);
        return true;
    }
    
}