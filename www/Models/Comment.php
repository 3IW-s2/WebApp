<?php

namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use App\Core\Database;
use PDO;
use App\Core\Mail;
use App\Repositories\UserRepository;
use Exception;

class Comment extends Database
{
    private Int $id = 0;
    private Text $content;
    private Int $status = 0;
    private Int $article_id = 0;
    private Int $user_id = 0;
    private Int $signaled = 0 ;
    private \DateTime $date_inserted;
    private \DateTime $date_updated;
    private $baseUrl;
    private $error;

    
    public function __construct( Error $error){
        $this->date_inserted = new \DateTime();
        $this->date_updated = new \DateTime();
        $this->error = $error;
        $this->loadConfig();

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

    /**
     * Get the value of status
     * @return Int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     * @param Int $status
     * @return  self
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the value of article_id
     * @return Int
     */
    public function getArticleId(): int
    {
        return $this->article_id;
    }

    /**
     * Set the value of article_id
     * @param Int $article_id
     * @return  self
     */ 
    public function setArticleId(int $article_id): self
    {
        $this->article_id = $article_id;
        return $this;
    }

    /**
     * Get the value of user_id
     * @return Int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     * @param Int $user_id
     * @return  self
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of signaled
     * @return Int
     */
    public function getSignaled(): int  
    {
        return $this->signaled;
    }

    /**
     * Set the value of signaled
     * @param Int $signaled
     * @return  self
     */
    public function setSignaled(int $signaled): self
    {
        $this->signaled = $signaled;
        return $this;
    }

    /**
     * Get the value of date_inserted
     * @return \DateTime
     */
    public function getDateInserted(): \DateTime
    {
        return $this->date_inserted;
    }

    /**
     * Set the value of date_inserted
     * @param \DateTime $date_inserted
     * @return  self
     */

    public function setDateInserted(\DateTime $date_inserted): self
    {
        $this->date_inserted = $date_inserted;
        return $this;
    }

    /**
     * Get the value of date_updated
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->date_updated;
    }

    /**
     * Set the value of date_updated
     * @param \DateTime $date_updated
     * @return  self
     */ 
    public function setDateUpdated(\DateTime $date_updated): self

    {
        $this->date_updated = $date_updated;
        return $this;
    }

    /**
     * Get the value of baseUrl
     * @return String
     */
    public function getBaseUrl(): String
    {
        return $this->baseUrl;
    }

    /**
     * Set the value of baseUrl
     * @param String $baseUrl
     * @return  self
     */
    public function setBaseUrl(String $baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * Get the value of error
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }

    /**
     * Set the value of error
     * @param Error $error
     * @return  self
     */
    public function setError(Error $error): self
    {
        $this->error = $error;
        return $this;
    }

}