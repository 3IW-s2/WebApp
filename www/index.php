<?php

namespace App;
use App\Core\Router;

session_start();
$timestamp = time();
$newTimestamp = strtotime('+2 hours', $timestamp);
$date = date('Y-m-d H:i:s', $newTimestamp);
$_SESSION["token_update_time"] = $date;



require 'vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', true);

//require "Core/View.php";

spl_autoload_register(function ($class) {

    //$class = App\Core\View
    $class = str_replace("App\\","", $class);
    //$class = Core\View
    $class = str_replace("\\","/", $class);
    //$class = Core/View
    $class = $class.".php";
    //$class = Core/View.php
    if(file_exists($class)){
        include $class;
    }
});


$uri = $_SERVER["REQUEST_URI"];

if ($_SERVER['REQUEST_URI'] === '/sitemap.xml') {
    include './sitemap.php';
    exit();
}

if (!file_exists("routes.yml")) {
    die("Le fichier routes.yml n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

$router = new Router($routes);
$router->handleRequest($uri);