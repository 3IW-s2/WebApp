<?php
namespace App\Core;

class Dump{
    
        public static function debug($var){
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
        }
    
        public static function debugDie($var){
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
            die();
        }
                
}