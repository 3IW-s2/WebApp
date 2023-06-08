<?php
namespace App\Models ;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;
use App\Repositories\MenuRepository;
use Exception;

class Menu 
{
    private Int $menu_id = 0;
    private Int $parent_id;
    private String $titre;
    private String $url ;

    public function __construct()
    {

    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->menu_id;
    }


    /**
     * @param Int $id 
     * @return self 
     */
    public function setId(int $id): self 
    {
        $this->menu_id = $id; 
        return $this;
    }

    /**
     * Get the value of parent_id
     * @return Int
     */
    public function getParentId(): int 
    {
        return $this->parent_id;
    }

    /**
     * Set the value of parent_id
     * @param Int $parent_id
     * @return  self
     */
    public function setParentId(int $parent_id): self
    {
        $this->parent_id = $parent_id;
        return $this;
    }


    /**
     * Get the value of titre
     * @return String
     */
    public function getTitre(): String
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     * @param String $titre
     * @return  self
     */
    public function setTitre(String $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get the value of url
     * @return String
     */
    public function getUrl(): String
    {
        return $this->url;
    }

    /**
     * Set the value of url
     * @param String $url
     * @return  self
     */
    public function setUrl(String $url): self
    {
        $this->url = $url;
        return $this;
    }
}