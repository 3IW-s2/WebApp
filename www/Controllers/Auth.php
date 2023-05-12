<?php

namespace App\Controllers;

use App\Models\User;

class Auth
{
    public function login(): void
    {
        echo "Page de connexion";
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