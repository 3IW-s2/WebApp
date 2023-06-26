<?php
namespace App\Services;

use App\Models\History;
use App\Repositories\HistoryRepository;
use App\Core\Error;
use App\Core\Security;
use App\Core\Database;
use PDO;

class HistoryService
{

    private $historyRepository;

    public function __construct()
    {
        $this->historyRepository = new HistoryRepository();
    }

    public function addHistory(History $history){
    
        $this->historyRepository->addHistory($history);
    }

    public function getHistoryForEntity(History $history){
    
        return $this->historyRepository->getHistoryForEntity($history);
    }
}