<?php

namespace App\Repositories;

use App\Core\Configuration\DatabaseConfiguration;
use App\Services\HistoryService;
use App\Models\History;
use App\Core\Database;
use App\Models\Comment;
use App\Core\Error;
use PDO;
use Exception;

class HistoryRepository
{
    private $db; 

    public function __construct()
    {
        $this->table = DatabaseConfiguration::getDatabaseConfig()["DB_PREFIX"]."_".'history';
        $this->db = Database::getInstance();
    }

    public function addHistory( History $history)
    {
        $query = "INSERT INTO {$this->table} (table_name, entity_type, entity_id, action, created_at, content)
                  VALUES (:table_name, :entity_type, :entity_id, :action, NOW(), :content)";

        $params =[
            'table_name' => $history->getTableName(),
            'entity_type' => $history->getEntityType(),
            'entity_id' => $history->getEntityId(),
            'action' => $history->getAction(),
            'content' => $history->getContent()
        ];
        $statement = $this->db->query($query, $params);
        //$history = $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getHistoryForEntity( History $history)
    {
        $query = "SELECT * FROM {$this->table} WHERE table_name = :table_name AND entity_id = :entity_id  AND  entity_type= :entity_type ORDER BY created_at DESC";

        $params = [
            'table_name' => $history->getTableName(),
            'entity_id' => $history->getEntityId(),
            'entity_type' => $history->getEntityType()
        ];

        $statement = $this->db->query($query, $params);
        $history = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $history;
        
    }
 

    // Autres méthodes utiles pour l'historique (mise à jour, suppression, etc.)
}
