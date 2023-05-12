<?php
/*
 *  Convention de nommage : Pascal Case
 *
 *
 */
class House {
    //Propriété ou des attributs
    private $wall = 4;
    private $fundation  = 1;
    private $roof = 1;
    private $window = 1;
    private $door = 1;
    private $stage = 0;

    //methodes
    public function addStage(): void
    {
        $this->stage++;
        $this->wall+=4;
        $this->window++;
    }
}

// myHouse est un objet c'est l'instance de la class House
// myHouse c'est un objet construit à partir du plan House
$myHouse = new House();
$myHouse->addStage();
//$myHouse->stage++;
var_dump($myHouse);
