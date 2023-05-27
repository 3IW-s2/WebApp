<?php

namespace App\Models;

use App\Core\Error;
use App\Core\SQL;
use App\Core\Database;
use PDO;
use App\Core\Mail;
use App\Repositories\UserRepository;
use Exception;
class User extends Database
{
    private Int $id = 0;
    private String $firstname;
    private String $lastname;
    private String $email;
    private String $pwd;
    private String $country;
    private String $role;
    private Int $status = 0;
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

    /**
     * @return String
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param String $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
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
     
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error->addError("L'adresse email n'est pas valide");
            return false; 
        }
        if (empty($password)) {
            $this->error->addError("Le mot de passe est obligatoire");
            return false;
        }
        
        $userRepo = new UserRepository();
        $user = $userRepo->getUserByEmail($email);
      /*   var_dump($user['password']);
        die;  */
        try{
            if ($user && password_verify($password, $user['password'])) {
                //$_SESSION["user"] = $user;
                $_SESSION["user"] = $user['email'];
                return true;
            } else {
                $this->error->addError("identifiants incorrects");
                return false;
            }
        } catch (\Exception $e) {
            $this->error->addError(" Un problème est survenu lors de la connexion");
            return false;
        }

    }

    /**
     * @param String $email
     * @return bool
     */
    public function forgotPassword(string $email): bool
    {
       /*  $db = Database::getInstance();
        $resetToken = bin2hex(random_bytes(32)); */
        
       
       /*  $query = "UPDATE users SET reset_token = :token WHERE email = :email";
        $params = [
            'email' => $email,
            'token' => $resetToken
        ]; */
        try{
            $userRepo = new UserRepository();
           
            $user = $userRepo->resetToken($email);
            $url = $this->baseUrl . '/resetpassword?token='.$user;
          /*   var_dump($user);
            die; */
          /*   $statement = $db->query($query, $params);
            $user = $statement->fetch(PDO::FETCH_ASSOC); */
            $mail = new Mail($email, "Réinitialisation de votre mot de passe ici", "Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe : " . $url . "");
            $mail->send();
    
            return true;
        }
        catch( \Exception $e){
            echo $e->getMessage();
            return false;
        }
      
    }

    /**
     * @param String $email
     * @param String $password
     * @return bool
     */
    public function resetPassword(string $email, string $password): bool
    {
       /*  $db = Database::getInstance();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :password , reset_token = NULL WHERE email = :email";
        $params = [
            'email' => $email,
            'password' => $hashedPassword
        ];

        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC); */

        $userRepo = new UserRepository();
        $user = $userRepo->resetPassword($email, $password);

        if ($user) {
            $_SESSION["user"] = $user;
           
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
            $_SESSION["user"] = $user;
            return true;
        } else {

            return false;
        }
    }
    /**
     * @param String $token
     * @return bool
     */
    public function checkActiveToken(string $token): bool
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM users WHERE active_account_token = :token";
        $params = [
            'token' => $token
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
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param string|null $role
     * @return bool
     */
    public function register(string $firstname, string $lastname, string $email, string $password, ?string $role = null): bool
    {
        $db = Database::getInstance();
        $activetoken = bin2hex(random_bytes(32));
        $url = $this->baseUrl . '/activate?token='.$activetoken;

        $query = "SELECT * FROM users WHERE email = :email";
        $params = [
            'email' => $email,
        ];

        try {
            $statement = $db->query($query, $params);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $this->error->addError("L'utilisateur existe déjà");
                return false; 
            }


            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (firstname, lastname, email, password, role, created_at, updated_at) 
                      VALUES (:firstname, :lastname, :email, :password, :role, NOW(), NOW())";
            $params = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role,
            ];

            if($firstname == "" || $lastname == "" || $email == "" || $password == ""){
                $this->error->addError("Veuillez remplir tous les champs");
                return false; 
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error->addError("L'adresse email n'est pas valide");
                return false; 
            }

            if (strlen($password) < 8) {
                $this->error->addError("Le mot de passe doit contenir au moins 8 caractères");
                return false; 
            }

            if (!preg_match("#[0-9]+#", $password)) {
                $this->error->addError("Le mot de passe doit contenir au moins 1 chiffre");
                return false; 
            }


            $db->query($query, $params);

            // Envoi de l'e-mail avec update du token
            $db = Database::getInstance();
            
            $query = "UPDATE users SET active_account_token = :token  WHERE email = :email";
            $params = [
                'email' => $email,
                'token' => $activetoken
            ];

            $db->query($query, $params);



            $mail = new mail ($email, "Bienvenue sur notre site", "Veuillez cliquer sur ce lien pour activer votre compte : " . $url . "");
            $mail->send();

            return true; 
        } catch (\Exception $e) {
            error_log($e->getMessage()); 
            $this->error->addError("Une erreur s'est produite lors de l'enregistrement de l'utilisateur");
            return false; 
        }
    }

    public function getError(): Error
    {
        return $this->error;
    }

}
