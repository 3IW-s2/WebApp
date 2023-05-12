<?php

interface IntVehicule{
    public function accelerate(): void;
}


abstract class Vehicle{
    public $motor = 1;
    public $speed = 0;
    public function __construct()
    {
        echo "Construction d'un véhicule";
    }

    public function accelerate(){
        $this->speed++;
    }

}

class Car extends Vehicle implements IntVehicule{
    public $wheel = 4;
    public function __construct()
    {
        echo "Construction d'une voiture";
        parent::__construct();

    }
    public function accelerate($speed = 0): void
    {
        $this->speed++;
    }
}

class Bike extends Vehicle implements IntVehicule{
    public $wheel = 2;
    public function accelerate(): void
    {
        $this->speed+=2;
    }

}

$myCar = new Car();
$myCar->accelerate();
var_dump($myCar);