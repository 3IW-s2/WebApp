<?php 
namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;
use App\Repositories\ArticleTypeRepository;
use Exception;

class ArticleType
{
    private Int $id;
    private String $name;


    public function __construct()
    {
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
     * @return self 
     */
    public function setId(int $id): self
    {
        $this->id = $id; 
        return $this;
    }

    /**
     * Get the value of name
     * @return String
     */

    public function getName(): String
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * @param String $name
     * @return self
     */

    public function setName(String $name): self
    {
        $this->name = $name;
        return $this;
    }


}