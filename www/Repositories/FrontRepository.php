<?php

namespace App\Repositories;

use App\Models\Font;
use App\Core\Database;
use App\Models\Comment;
use App\Core\Error;
use App\Models\Front;
use PDO;
use Exception;

class FrontRepository extends Database
{
    private $error;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->error = new Error();
    }

    public function getFrontManagement()
    {
        $query = "SELECT * FROM front";
        $statement = $this->db->query($query);
        $front = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $front[0];
    }

    public function updateFrontManagement(Front $front){
        $query = "UPDATE front SET font = :font, font_weight = :font_weight, primary_color = :primary_color, logo = :logo, updated_at = NOW() WHERE id = :id";
        $params = [
            'font' => $front->getFont(),
            'font_weight' => $front->getFontWeight(),
            'primary_color' => $front->getPrimaryColor(),
            'logo' => $front->getLogo(),
            'id' => $front->getId()
        ];

        $statement = $this->db->query($query, $params);

        return true;
    }




}