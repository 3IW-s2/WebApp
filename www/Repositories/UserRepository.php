<?php

namespace App\Repositories;

use App\Services\UserService;
use App\Core\Database;
use App\Models\User;
use App\Core\Mail;
use App\Core\Error;
use PDO;
use Exception;

class  UserRepository   extends Database 
{
    public function findById (int $id): User
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM user WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function createUser (User $user): void
    {
        $db = Database::getInstance();

        $query = "INSERT INTO user (email, password, firstname, lastname, role) VALUES (:email, :password, :firstname, :lastname, :role)";
        $params = [
            'email' => $user->getEmail(),
            'password' => $user->getPwd(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'role' => $user->getRole()
        ];
        
        try{
            $statement = $db->query($query, $params);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function getUserByEmail (string $email)
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM users WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $db->query($query, $params);
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
        $db = Database::getInstance();
        $resetToken = bin2hex(random_bytes(32));
        /* var_dump($resetToken);
        die; */
       // $user = $statement->fetch(PDO::FETCH_ASSOC);

        $query = "UPDATE users SET reset_token = :token WHERE email = :email";
        $params = [
            'email' => $email,
            'token' => $resetToken
        ];
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
 
        return $resetToken;
    }

    public function resetPassword (string $email, string $password)
    {
        $db = Database::getInstance();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :password , reset_token = NULL WHERE email = :email";
        $params = [
            'email' => $email,
            'password' => $hashedPassword
        ];
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }


    public function checkToken (string $token)
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM users WHERE reset_token = :token";
        $params = [
            'token' => $token
        ];
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function checkActiveToken (string $token)
    {
        $db = Database::getInstance();

        $query = "SELECT * FROM users WHERE active_account_token = :token";
        $params = [
            'token' => $token
        ]; 
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function register(string $firstname, string $lastname, string $email, string $password, ?string $role = null): bool
    {
        $db = Database::getInstance();
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
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return true;
    }

    public function updateToken( string $email){
        $db = Database::getInstance();
        $activetoken = bin2hex(random_bytes(32));


        $query = "UPDATE users SET active_account_token = :token  WHERE email = :email";
            $params = [
                'email' => $email,
                'token' => $activetoken
            ];
        $statement = $db->query($query, $params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $activetoken;
    }

    public function deleteUserById(int $id): void
    {
        $db = Database::getInstance();

        $query = "DELETE FROM user WHERE id = :id";
        $params = [
            'id' => $id
        ];
        $statement = $db->query($query, $params);
    }

    public function deleteUserByEmail(string $email): void
    {
        $db = Database::getInstance();

        $query = "DELETE FROM user WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $statement = $db->query($query, $params);
    }

}