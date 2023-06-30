<?php
namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use PDO;
use App\Core\Security;

class Front
{
    private Int $id = 0;
    private String $font;
    private String $font_weight;
    private String $primary_color;
    private String $logo;
    private \DateTime $created_at;


    public function __construct()
    {
        $this->created_at = new \DateTime();
    }


    /**
     * @return String
     */
    public function getFont(): string
    {
        return $this->font;
    }

    /**
     * @param String $font
     */
    public function setFont(string $font): void
    {
        $this->font = $font;
    }

    /**
     * @return String
     */
    public function getFontWeight(): string
    {
        return $this->font_weight;
    }

    /**
     * @param String $font_weight
     */
    public function setFontWeight(string $font_weight): void
    {
        $this->font_weight = $font_weight;
    }

    /**
     * @return String
     */
    public function getPrimaryColor(): string
    {
        return $this->primary_color;
    }

    /**
     * @param String $primary_color
     */
    public function setPrimaryColor(string $primary_color): void
    {
        $this->primary_color = $primary_color;
    }

    /**
     * @return String
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param String $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
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



}