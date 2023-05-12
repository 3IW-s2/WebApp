<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Database;
use PDO;


class Auth
{



    public function login(): void
    {   
        $view = new View("Auth/login", "front");

       //faire le traitement du formulaire
        if(!empty($_POST)){
            $email = $_POST["name"];
            $pwd = $_POST["password"];

            $user = new User();
            $user->setEmail($email);
            $user->setPwd($pwd);
            $user->login( $email, $pwd);
        }
    }

    public function register(): void
    {
        $user = new User();
        $user->setFirstname("yVEs");
        $user->setLastname("SKrzYPczYK");
        $user->setEmail("y.SKRZypczyk@GMAil.com");
        $user->setPwd("Test1234");
        $user->setCountry("FR");
        $user->save();

    }

    public function logout(): void
    {
        echo "Page de déconnexion";
    }


}