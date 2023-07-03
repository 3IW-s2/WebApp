<?php

namespace App\Repositories;

use App\Services\UserService;
use App\Core\Database;
use App\Models\User;
use App\Core\Mail;
use App\Core\Error;
use PDO;
use Exception;

class  UserRepository  extends Database 
{
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }


    public function findById (User $user)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $user->getId()
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function expirateToken (string $email): bool
    {
        $expirate_token =  date('Y-m-d H:i:s', time() + (70 * 120));
        $query = "UPDATE {$this->table} SET expirate_token = :expirate_token WHERE email = :email";
        $params = [
            'email' => $email,
            'expirate_token' => $expirate_token
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return true ;

    }


    public function getExpireTokenByEmail (string $email)
    {

        $query = "SELECT expirate_token FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getStatusByEmail (string $email)
    {

        $query = "SELECT status FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }   


     public function getUserByEmail (string $email)
    {   

        $query = "SELECT * FROM {$this->table} WHERE email = :email AND status IS NOT NULL ";

        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if ($data) {
    
            return $data;
        }
    
        $this->error = new Error();
        $this->error->setCode(404);
        return false;

    } 

    public function resetToken(string $email)
    {
        $resetToken = bin2hex(random_bytes(32));
  

        $query = "UPDATE {$this->table} SET reset_token = :token , status = NULL  WHERE email = :email";
        $params = [
            'email' => $email,
            'token' => $resetToken
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
 
        return $resetToken;
    }

    public function resetPassword (string $email, string $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE {$this->table} SET password = :password , reset_token = NULL , status = 1 WHERE email = :email";
        $params = [
            'email' => $email,
            'password' => $hashedPassword
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
    public function resetTokenNull (string $email)
    {
        $query = "UPDATE {$this->table} SET reset_token = NULL WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function resetActiveTokenNull (string $email)
    {

        $query = "UPDATE {$this->table} SET active_account_token = NULL WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }


    public function checkToken (string $token)
    {
        $query = "SELECT * FROM {$this->table} WHERE reset_token = :token";
        $params = [
            'token' => $token
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
    public function setStatus(string $email)
    {
        $query = "UPDATE {$this->table} SET status = 1 WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function checkActiveToken (string $token)
    {
        $query = "SELECT * FROM {$this->table} WHERE active_account_token = :token";
        $params = [
            'token' => $token
        ]; 
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }


    public function verifRegister(string $email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $email
        ]; 
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return false;
        }

        return true;
    }

    public function register(string $firstname, string $lastname, string $email, string $password, ?string $role = null): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table} (firstname, lastname, email, password, role, created_at, updated_at) 
                VALUES (:firstname, :lastname, :email, :password, :role, NOW(), NOW())";

        $params = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $hashedPassword,
            'role' =>  5
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return true;
    }

    public function updateToken( string $email){
        $activetoken = bin2hex(random_bytes(32));


        $query = "UPDATE {$this->table} SET active_account_token = :token  WHERE email = :email";
            $params = [
                'email' => $email,
                'token' => $activetoken
            ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $activetoken;
    }

    public function deleteUserById(User $user): void
    {

        $query = "UPDATE {$this->table} SET status = 10 WHERE id = :id";
        $params = [
            'id' => $user->getId()
        ];
        $statement = $this->db->query($query, $params);

    }

    public function HandOverdeleteUserById(User $user): void
    {
        $query = "UPDATE {$this->table} SET status = 1 WHERE id = :id";
        $params = [
            'id' => $user->getId()
        ];
        $statement = $this->db->query($query, $params);

    }

    public function deleteUserByIdHard(User $user): void
    {

        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $user->getId()
        ];
        $statement = $this->db->query($query, $params);

    }
 

    public function deleteUserByEmail( User $user): void
    {
        $query = "DELETE FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $user->getEmail()
        ];
        $statement = $this->db->query($query, $params);

    }


    public function allUser (): array
    {
        $query = "SELECT * FROM users";
        $statement = $this->db->query($query);

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function updateUser ( User $user): void
    {

        $query = "UPDATE {$this->table} SET firstname = :firstname , lastname = :lastname , email = :email /* , password = :password */ ,  updated_at = NOW() WHERE id = :id";
        $params = [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            //'password' => $user->getPwd(),
        ];
        $statement = $this->db->query($query, $params);
     
        
    }

    public function getUserById (User $user)
    {

        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = [
            'id' => $user->getId()
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function addUser (User $user)
    {

        $query = "INSERT INTO {$this->table} (firstname, lastname, email, password,  created_at, updated_at) 
                VALUES (:firstname, :lastname, :email, :password,  NOW(), NOW())";
        $params = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPwd(),
          
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
       
    }

    public function addUserByApi(User $user)
    {
            
            $query = "INSERT INTO {$this->table} (firstname, lastname, email, password, role, status,  created_at, updated_at) 
                    VALUES (:firstname, :lastname, :email, :password, :role, :status,  NOW(), NOW())";
            $params = [
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPwd(),
                'role' =>  intval($user->getRole()),
                'status' => $user->getStatus()

            
            ];
            $statement = $this->db->query($query, $params);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
        
    }

    public function getExpirateTokenByEmail (string $email)
    {

        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $email
        ];
               $statement = $this->db->query($query, $params);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user['expirate_token'];
    }

    public function updateRole(User $user)
    {
        $query = "UPDATE {$this->table} SET role = :role WHERE id = :id";
        $params = [
            'id' => $user->getId(),
            'role' => $user->getRole()
        ];
        $statement = $this->db->query($query, $params);
    }


    public function findByEmail(User $user)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $user->getEmail()
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;

    }


    public function getUserIdByEmail (User $user)
    {
        $query = "SELECT id FROM {$this->table} WHERE email = :email";
        $params = [
            'email' => $user->getEmail()
        ];
        $statement = $this->db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user['id'];
    }

    public function getAllUserRemoved()
    {
        $query = "SELECT * FROM {$this->table} WHERE status = '10' ";
        $statement = $this->db->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getAllUserAct()
    {
        $query = "SELECT * FROM {$this->table} WHERE status = '1' ";
        $statement = $this->db->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getAllUserPending()
    {
        $query = "SELECT * FROM {$this->table} WHERE status is NULL AND  active_account_token is NOT NULL ";
        $statement = $this->db->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getAllUserOnline()
    { 

        $query = "SELECT * FROM {$this->table} WHERE  now() + INTERVAL '2 hours' < expirate_token; ";
        $statement = $this->db->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    

}