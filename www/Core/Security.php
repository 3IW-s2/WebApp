<?php
namespace App\Core;

use App\Core\Error;
use Exception;

class Security
{
    protected $error;

    public function __construct( Error $error )
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $this->error = $error;
    }

    public function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }

/*     public function checkId(string $id): bool
    {
        if (isset($_SESSION['id']) && $_SESSION['id'] === $id) {
            return true;
        }
        return false;
    } */

    public function checkToken(string $token): bool
    {
        if (isset($_SESSION['token']) && $_SESSION['token'] === $token) {
            unset($_SESSION['token']);
            return true;
        }
        return false;
    }

    public function checkAdmin(): bool
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return true;
        }
        return false;
    }

    public function checkUser(): bool
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
            return true;
        }
        return false;
    }

    public function checkLogged(): bool
    {
        if (isset($_SESSION['role'])) {
            return true;
        }
        return false;
    }

    public function checkEmail(string $email)
    {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //$error = new Error();
            $this->$error->addError("L'adresse email n'est pas valide");
            var_dump($error);
            die;
        

            return false;
        }
        return true;
       
    }

    public function checkPassword(string $password): bool
    {
        if (strlen($password) >= 8) {
            return true;
        }
        return false;
    }

    public function passwordNotEmpty(string $password): bool
    {
        if (strlen($password) > 0) {
            return true;
        }
        $this->error->addError("Le mot de passe est obligatoire");
        return false;
    }

    public function checkFirstname(string $firstname): bool
    {
        if (strlen($firstname) >= 2) {
            return true;
        }
        return false;
    }

    public function checkLastname(string $lastname): bool
    {
        if (strlen($lastname) >= 2) {
            return true;
        }
        return false;
    }

    public function checkRole(string $role): bool
    {
        if ($role === 'admin' || $role === 'user') {
            return true;
        }
        return false;
    }

 

    public function checkString(string $string): bool
    {
        if (strlen($string) > 0) {
            return true;
        }
        return false;
    }

    public function checkEmailAndPassword(string $email, string $password): bool
    {
        if ($this->checkEmail($email) && $this->checkPassword($password)) {
            return true;
        }
        return false;
    }

    
}