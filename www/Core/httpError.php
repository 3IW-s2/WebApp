<?php 
namespace App\Core ;

class httpError
{
    public function httpError($method)
    {
        if( $_SERVER['REQUEST_METHOD'] !== $method){
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
            exit();
        }
    }

    public function httpOriginError( $origin )
    {
        $array = getallheaders();
        foreach($array as $key => $value){
            if($key === "Host" && $value !== $origin){
                http_response_code(405);
                echo json_encode(['message' => 'Method not allowed from this origin']);
                exit();
            }
        }
    }

}