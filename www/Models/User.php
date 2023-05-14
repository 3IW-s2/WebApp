<?php

namespace App\Models;

use App\Core\SQL;
use App\Core\Database;
use PDO;
use App\Core\Mail;

class User extends SQL
{
    private Int $id = 0;
    private String $firstname;
    private String $lastname;
    private String $email;
    private String $pwd;
    private String $country;
    private Int $status = 0;
    private \DateTime $date_inserted;
    private \DateTime $date_updated;

    public function __construct(){
        $this->date_inserted = new \DateTime();
        $this->date_updated = new \DateTime();

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

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param String $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtoupper(trim($country));
    }

    /**
     * @return Int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param Int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDateInserted(): \DateTime
    {
        return $this->date_inserted;
    }

    /**
     * @param \DateTime $date_inserted
     */
    public function setDateInserted(\DateTime $date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->date_updated;
    }

    /**
     * @param \DateTime $date_updated
     */
    public function setDateUpdated(\DateTime $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    /**
     * @param String $name
     * @param String $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
    $db = Database::getInstance();

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $params = [
        'email' => $email,
        'password' => $password
    ];

    $statement = $db->query($query, $params);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user"] = $user;
        return true;
    } else {

        return false;
    }

    }
    
    /**
     * return bool
     */
    public function register(): bool
    {
        $db = Database::getInstance();

        $query = "INSERT INTO users (firstname, lastname, email, password,  date_inserted, date_updated) VALUES (:firstname, :lastname, :email, :password, :country, :status, :date_inserted, :date_updated)";
        $params = [
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'password' => $this->getPwd(),
            'date_inserted' => $this->getDateInserted(),
            'date_updated' => $this->getDateUpdated()
        ];

        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION["user"] = $user;
            return true;
        } else {

            return false;
        }
    }

    /**
     * @param String $email
     * @return bool
     */
    public function forgotPassword(string $email): bool
    {
        $db = Database::getInstance();
        $resetToken = bin2hex(random_bytes(32));

        $query = "UPDATE users SET reset_token = :token WHERE email = :email";
        $params = [
            'email' => $email,
            'token' => $resetToken
        ];
        //mettre à jour la valeur du token dans la table users
        $statement = $db->query($query, $params);


        $mail = new Mail($email, "Réinitialisation de votre mot de passe ici", "http://gavinaperano.com:88/reset?token=" .$resetToken. "");
        $mail->send();

        return true;

    }

    /**
     * @param String $email
     * @param String $password
     * @return bool
     */
    public function resetPassword(string $email, string $password): bool
    {
        $db = Database::getInstance();

        $query = "UPDATE users SET password = :password WHERE email = :email";
        $params = [
            'email' => $email,
            'password' => $password
        ];

        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
           
            return true;
        } else {

            return false;
        }
    }

    /**
     * @param String $token
     * @return bool
     */
    public function checkToken(string $token): bool
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM users WHERE reset_token = :token";
        $params = [
            'token' => $token
        ];

        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        } else {

            return false;
        }
    }


}
