<?php

namespace App\Controllers;

use App\Core\View;

class Main
{
    public function home(): void
    {
        var_dump($_SESSION);
        $timestamp = time();
        $newTimestamp = strtotime('+2 hours', $timestamp);
        $date = date('Y-m-d H:i:s', $newTimestamp);
        echo $date;

        $pseudo = "Prof";
        $view = new View("Main/home", "front");
        $view->assign("pseudo", $pseudo);
        $view->assign("age", 30);
        $view->assign("titleseo", "supernouvellepage");
    }

    public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    }

}