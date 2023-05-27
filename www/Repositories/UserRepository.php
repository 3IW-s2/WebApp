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
            /* $userObj = new User();
            $userObj->setEmail($data['email']);
            $userObj->setPwd($data['password']);
            $userObj->setFirstname($data['firstname']);
            $userObj->setLastname($data['lastname']);
            $userObj->setRole($data['role']); */

            // Définir les autres propriétés de l'utilisateur
    
            return $data;
        }
    
        $this->error = new Error();
        $this->error->setCode(404);
        return false;

    }


}