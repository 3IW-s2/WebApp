<?php

namespace App\Repositories;

use App\Services\UserService;
use App\Core\Database;
use App\Models\User;
use App\Core\Mail;
use App\Core\Error;
use PDO;
use Exception;

class  UserRepository  
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


}