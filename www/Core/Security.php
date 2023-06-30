<?php
namespace App\Core;

use App\Core\Error;
use App\Core\View;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Core\Database;
use Exception;
 
class Security extends Database
{
    protected $error;

    public function __construct( Error $error )
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $this->error = $error;
    }

    public static function checkSecurity(string $security): bool
    {
        $security = explode(":", $security);
        $securityType = $security[0];
        $securityValue = $security[1];

        switch ($securityType) {
            case "ROLE":
                return self::checkRole($securityValue);
                break;
          /*   case "CSRF":
                return self::checkToken($securityValue);
                break; */
            case "IS_AUTHENTICATED":
                return self::checkLogged();
                break;
            case "IS_ANONYMOUS":
                return !self::checkLogged();
                break;
            default:
                throw new Exception("Le type de sécurité " . $securityType . " n'existe pas");
        }
    }

 
    
    public function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }



    public static function checkToken(): bool
    {
        $userRepo = new UserRepository();
   
        $checkSession = self::checkSession();

        if(!$checkSession) {
           return false;
        }
        

        $token = $_SESSION["expire_token"];
        $expirationTimestamp = strtotime($token);
     


        $timestamp = time();
        $newTimestamp = strtotime('+2 hours', $timestamp);
        $date_now = date('Y-m-d H:i:s', $newTimestamp);
     


        if($expirationTimestamp > time()) {

            if($_SESSION["token_update_time"] === $date_now) {
            
                $userUpdateToken = $userRepo->expirateToken($_SESSION['user']);
                $_SESSION["expire_token"] = date('Y-m-d H:i:s', time() + (70 * 120));
    
                return true;
            }
       
            return true;
        } 
        return false;
    }

    public static function editor()
    {
        $userRepo = new UserRepository();
        $user = $userRepo->getUserByEmail($_SESSION['user']);
        if($user['role'] === 3) {
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
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function checkEmail(string $email)
    {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //$error = new Error();
            $this->$error->addError("L'adresse email n'est pas valide");
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

    public static function checkRole(string $role): bool
    {  
        $userRepo = new UserRepository();
   
        $checkSession = self::checkSession();

        if(!$checkSession) {
           return false;
        }
        $email = $_SESSION["user"];
        $user = $userRepo->getUserByEmail($email);


        if ( $role === 'ADMIN' && ($user['role'] === 1 || $user['role'] === 3) ) {
            return true;
        }
        return false;
    }

    public static function checkSession (): bool
    {
         if (empty($_SESSION['user'])) {
              return false;
            }
        return true;
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

    public function checkBool (bool $bool): bool
    {
        if ($bool === true) {
            return true;
        }
        return false;
    }


    public function check404( $arg)
    {
        if (empty($arg)){
           // header("Location: /error");
           $error = new Error();
           $error->setCode(404);
           $view = new View("Auth/404" , "error" );
            exit();
        }
        return true;
    }

    public function checkId404(int $id)
    {
        if ($id > 0) {
            return true;
        }
        header("Location: /error");
        return false;
    }

   
}
