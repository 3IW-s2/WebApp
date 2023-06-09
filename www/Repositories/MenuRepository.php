<?php
namespace App\Repositories;

use App\Services\ArticleService;
use App\Core\Database;
use App\Models\Menu;
use App\Core\Mail;
use App\Core\Error;
use App\Core\Security;
use PDO;
use Exception;

class MenuRepository
{
    
        private $db;
        private $table = "menu";
    
        public function __construct()
        {
            $this->db = Database::getInstance();
        }
    
        public function findAll()
        {
            $query = "SELECT * FROM {$this->table} ORDER BY menu_id ASC";
            $stmt = $this->db->query($query);
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $menus;
        }
    
        public function createMenu(Menu $menu){
        
            $query = "INSERT INTO {$this->table} (titre, url , status) VALUES (:titre, :url , :status)";
            $params = [
                'titre' => $menu->getTitre(),
                'url' => $menu->getUrl(),
                'status' => '5',
            ];
            $stmt = $this->db->query($query ,$params);
        }

        public function createSubMenu(Menu $menu){
        
            $query = "INSERT INTO {$this->table} ( parent_id, titre, url, status) VALUES ( :parent_id, :titre, :url, :status)";
            $params = [
                'parent_id' => $menu->getParentId(),
                'titre' => $menu->getTitre(),
                'url' => $menu->getUrl(),
                'status' => '5',
            ];
            $stmt = $this->db->query($query ,$params);
        }

    
        public function updateMenu(Menu $menu){
        
            $query = "UPDATE {$this->table} SET parent_id = :parent_id, titre = :titre, url = :url WHERE menu_id = :menu_id";
            $params = [
                'menu_id' => $menu->getId(),
                'parent_id' => $menu->getParentId(),
                'titre' => $menu->getTitre(),
                'url' => $menu->getUrl(),
            ];
            $stmt = $this->db->query($query , $params);
        }
    
        public function deleteMenu(Menu $menu){
        
            $query = "DELETE FROM {$this->table} WHERE menu_id = :menu_id";
            $params = [
                'menu_id' => $menu->getId(),
            ];
            $stmt = $this->db->query($query , $params);
        }

        public function findAllParent()
        {
            $query = "SELECT * FROM {$this->table} WHERE parent_id IS NOT  NULL  ORDER BY menu_id ASC";
            $stmt = $this->db->query($query);
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $menus;
        }

        public function findOneById(Menu $menu)
        {
            $query = "SELECT * FROM {$this->table} WHERE menu_id = :menu_id";
            $params = [
                'menu_id' => $menu->getId(),
            ];
            $stmt = $this->db->query($query, $params);
            $menu = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $menu;
        }

        public function pendingMenu(Menu $menu)
        {
            $query = "UPDATE {$this->table} SET status = :status WHERE menu_id = :menu_id";
            $params = [
                'menu_id' => $menu->getId(),
                'status' => '5',
            ];
            $stmt = $this->db->query($query, $params);
        }

        public function publishMenu(Menu $menu){
            
                $query = "UPDATE {$this->table} SET status = :status WHERE menu_id = :menu_id";
                $params = [
                    'menu_id' => $menu->getId(),
                    'status' => '1',
                ];
                $stmt = $this->db->query($query , $params);
        }

        public function activeLink(){
            
            $query = "SELECT * FROM {$this->table} WHERE status = '1' ";
     
            $stmt = $this->db->query($query);
            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $menus;
        }
    
}
