<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\View;

class Auth
{
    private $name;
    private $password;


    public function login(): void
    {   
        $view = new View("Auth/login", "front");

        if(isset($_POST['name'])){
            $this->setName($_POST['name']);
        }

        if(isset($_POST['password'])){
            $this->setPassword($_POST['password']);
        }

        // Accédez aux valeurs en utilisant les getters
        $name = $this->getName();
        $password = $this->getPassword();

        $pdo = new PDO('mysql:host=gavinaperano.com;dbname=database_tiw', 'postgres', 'postgres');

        $query = $pdo->prepare('SELECT * FROM users WHERE name = :name AND password = :password');

        $query->execute([
            'name' => $name,
            'password' => $password
        ]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /');
        } else {
            echo "Identifiants incorrects";
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
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}