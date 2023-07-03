<?php 
namespace App\Controllers\Api;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Core\Error;


class ApiUserController
{
    public function getUser()
    {
        $user = new UserRepository();
        $users = $user->findAll();       
        echo json_encode($users);
    }

    public function deleteUser()
    {   
        if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            return;
        }else{
            http_response_code(207);
            $user = new UserRepository();
            $userModel = new User( new Error());
            $userModel->setId($_GET['id']);
            $user->deleteUserByIdHard($userModel);
        }
       
    } 
}