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
        $user = new UserRepository();
        $userModel = new User( new Error());
        $userModel->setId($_GET['id']);
        $user->deleteUserByIdHard($userModel);
    } 
}