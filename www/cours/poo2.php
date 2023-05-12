<?php

class User {
    private $firstname;
    private $lastname;
    private $email;
    private $pwd;

    public function __construct($firstname, $lastname, $email, $pwd)
    {
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setEmail($email);
        $this->setPwd($pwd);
    }

    public function __toString()
    {
        return "Le prénom c'est ".$this->firstname. " et le nom c'est ".$this->lastname;
    }

    public function __invoke()
    {
        echo "test";
    }

    //ACCESSORS getter et setter
    public function setFirstname (String $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }
    public function setLastname (String $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }
    public function setEmail (String $email): void
    {
        $this->email = strtolower(trim($email));
    }
    public function setPwd (String $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }


    public function getFirstname(): String
    {
        return $this->firstname;
    }
    public function getLastname(): String
    {
        return $this->lastname;
    }
    public function getEmail(): String
    {
        return $this->email;
    }
    public function getPwd(): String
    {
        return $this->pwd;
    }

}

$myUser = new User("yves", "skrzypczyk", "y.skrzypczyk@gmail.com", "Test1234");
/*
$myUser->setFirstname("yves");
$myUser->setLastname("SkrzYPCZyk");
$myUser->setEmail("y.SKrzypczYK@gmail.com");
$myUser->setPwd("Test1234");
*/
$myUser->setLastname("Toto");

echo $myUser->getFirstname();


$myUser();

echo $myUser;