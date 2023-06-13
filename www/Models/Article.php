<?php 
namespace App\Models ;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;
use App\Repositories\ArticleRepository;
use Exception;

class Article 
{

    private Int $id = 0;
    private String $title;
    private String $author;
    private String $status;
    private String $content;
    private String $slug;
    private \DateTime $created_at;
    private \DateTime $update_at;
    private ?String $image_path;

    

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->update_at = new \DateTime();
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

    /**
     * Get the value of slug
     * @return String
     */
    public function getSlug(): String
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     * @param String $slug
     * @return  self
     */
    public function setSlug(String $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get the value of created_at
     * @return \DateTime
     */
    public function getcreated_at(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     * @param \DateTime $created_at
     * @return  self
     */
    public function setcreated_at(\DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
    
    /**
     * Get the value of update_at
     * @return \DateTime
     */
    public function getupdate_at(): \DateTime
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     * @param \DateTime $update_at
     * @return  self
     */
    public function setupdate_at(\DateTime $update_at): self
    {
        $this->update_at = $update_at;
        return $this;
    }

    /**
     * Get the value of image_path
     * @return String
     */
    public function getImage_path(): ?String
    {
        return $this->image_path;
    }

    /**
     * Set the value of image_path
     * @param String $image_path
     * @return  self
     */
    public function setImage_path(?String $image_path): self
    {
        $this->image_path = $image_path;
        return $this;
    }
}

    

