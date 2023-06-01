<?php 
namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;
use App\Repositories\UserRepository;
use Exception;

class Post 
{
    private Int $id = 0;
    private String $title;
    private String $author;
    private String $status;
    private Text $comment;
    private Text $content;


     /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of title
     * @return String
     */
    public function getTitle(): String
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * @param String $title
     * @return  self
     */
    public function setTitle(String $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of author
     * @return String
     */
    public function getAuthor(): String
    {
        return $this->author;
    }

    /**
     * Set the value of author
     * @param String $author
     * @return  self
     */
    public function setAuthor(String $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get the value of status
     * @return String
     */
    public function getStatus(): String
    {
        return $this->status;
    }

    /**
     * Set the value of status
     * @param String $status
     * @return  self
     */
    public function setStatus(String $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the value of comment
     * @return Text
     */
    public function getComment(): Text
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     * @param Text $comment
     * @return  self
     */
    public function setComment(Text $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get the value of content
     * @return Text
     */
    public function getContent(): Text
    {
        return $this->content;
    }

    /**
     * Set the value of content
     * @param Text $content
     * @return  self
     */
    public function setContent(Text $content): self
    {
        $this->content = $content;
        return $this;
    }

    

}