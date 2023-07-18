<?php 
namespace App\Pluggins;

use App\Core\Error;


class Ip{
    
        private $error;
    
        public function __construct()
        {
            $this->error = new Error();
        }
    
        public function getIp()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            if(filter_var($ip, FILTER_VALIDATE_IP)){
                return $ip;
            }else{
                $this->error->set("ip", "ip invalide");
            }

        }

}