<?php
namespace App\Repositories;

use App\Services\ArticleService;
use App\Core\Database;
use App\Models\Article;
use App\Core\Mail;
use App\Core\Error;
use App\Core\Security;
use PDO;
use Exception;

class ArticleRepository
{

    private $db;
    private $table = "articles";

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

}
