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
    private String $content;
    private Bool $status;
    private Int $post_id = 0;
    private Int $user_id = 0;
    private Int $signaled = 0;
    private \DateTime $date_inserted;
    private \DateTime $date_updated;
    private $baseUrl;
    private $error;

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    /**
     * @return Int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param Int $post_id
     */
    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }


    public function __construct( Error $error){
        $this->date_inserted = new \DateTime();
        $this->date_updated = new \DateTime();
        $this->error = $error;
        $this->loadConfig();

    }

    private function loadConfig() {
        $configFile = __DIR__ . '/../config.yml';
        $config = yaml_parse_file($configFile);

        $this->baseUrl = $config['base_url'];
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
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getComment():String
    {
        return $this->comment;
    }

    public function setComment(String $comment):void
    {
        $this->comment = $comment;
    }

    public function getStatus():Bool
    {
        return $this->status;
    }

    public function setStatus(Bool $status):void
    {
        $this->status = $status;
    }

    public function getArticleId():Int
    {
        return $this->post_id;
    }

    public function setArticleId(Int $post_id):void
    {
        $this->post_id = $post_id;
    }

    public function getUserId():Int
    {
        return $this->user_id;
    }

    public function setUserId(Int $user_id):void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return Int
     */
    public function getSignaled(): int
    {
        return $this->signaled;
    }

    /**
     * @param Int $signaled
     */
    public function setSignaled(int $signaled): void
    {
        $this->signaled = $signaled;
    }
    

}
