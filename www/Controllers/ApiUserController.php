<?php 
namespace App\Controllers;

use App\Repositories\UserRepository;


class ApiUserController
{
    public function getUser()
    {
        $user = new UserRepository();
        $users = $user->findAll();
        echo json_encode($users);
    }

   /*  public function deleteUser()
    {
        $user = new UserRepository();
        $user->deleteUser($_GET['id']);
    } */
}