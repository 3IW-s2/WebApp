<?php 
namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;

class History 
{
    private Int $id = 0;
    private String $table_name;
    private String $entity_type;
    private Int $entity_id;
    private ?String $action;
    private \DateTime $created_at;
    private  String $content;

    public function __construct()
    {
        $this->created_at = new \DateTime();
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
     * Get the value of table_name
     * @return String
     */
    public function getTableName(): String
    {
        return $this->table_name;
    }

    /**
     * Set the value of table_name
     * @param String $table_name
     * @return  self
     */
    public function setTableName(String $table_name): self
    {
        $this->table_name = $table_name;
        return $this;
    }

    /**
     * Get the value of entity_type
     * @return String
     */
    public function getEntityType(): String
    {
        return $this->entity_type;
    }

    /**
     * Set the value of entity_type
     * @param String $entity_type
     * @return  self
     */
    public function setEntityType(String $entity_type): self
    {
        $this->entity_type = $entity_type;
        return $this;
    }

    /**
     * Get the value of entity_id
     * @return Int
     */
    public function getEntityId(): int
    {
        return $this->entity_id;
    }

    /**
     * Set the value of entity_id
     * @param Int $entity_id
     * @return  self
     */
    public function setEntityId(int $entity_id): self
    {
        $this->entity_id = $entity_id;
        return $this;
    }

    /**
     * Get the value of action
     * @return String
     */
    public function getAction(): String
    {
        return $this->action;
    }

    /**
     * Set the value of action
     * @param String $action
     * @return  self
     */
    public function setAction(String $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get the value of created_at
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     * @param \DateTime $created_at
     * @return  self
     */
    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get the value of content
     * @return String
     */
    public function getContent(): String
    {
        return $this->content;
    }

    /**
     * Set the value of content
     * @param String $content
     * @return  self
     */
    public function setContent(String $content): self
    {
        $this->content = $content;
        return $this;
    }

}