<?php
namespace App\Controllers\Api;

use JsonException;

abstract class Api{

    private array $allowedMethods = [];
    private array $allowedVerbs;
    private mixed $host;

    public function __construct()
    {
        $this->allowedVerbs = ["GET", "HEAD", "POST", "PUT", "DELETE", "CONNECT", "OPTIONS", "TRACE", "PATCH"];
        $this->host = $this->setHost();
    }

    /**
     *
     * @param array|null $methods Array of allowed methods (HTTP verbs)
     * @return void
     */
    public function setAllowedMethods(array|null $methods = null): void{
        if($methods){
            $methods = array_filter($methods, function($method){
                $method = strtoupper(trim($method));
                return in_array($method, $this->allowedVerbs, true);
            });

            $this->allowedMethods = $methods;
        }
    }

    public function setHost(): mixed
    {
        $configFile = __DIR__ . '/../../config.yml';
        return yaml_parse_file($configFile)["origin"] ?? null;
    }

    /**
     * Function to return a JSON response with data and HTTP status code
     * @param array $data Array of data to return as JSON
     * @param int $code HTTP status code to return
     * @return void
     * @throws JsonException
     */
    public function jsonResponse(array $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);
        exit();
    }

    /**
     * Function to check if the origin is allowed
     * @param $origin
     * @return bool
     */
    public function isOriginAllowed($origin): bool{
        $array = getallheaders();
        foreach($array as $key => $value){
            if($key === "Host" && $value !== $origin){
                return false;
            }
        }
        return true;
    }

    /**
     * Function to dispatch the request to the appropriate method based on the HTTP verb
     * @return void
     * @throws JsonException
     */
    public function dispatch(): void {

        if(is_null($this->host)){
            $this->jsonResponse(["message" => "Missing origin configuration"], 405);
        }

        if(empty($this->allowedMethods)){
            $this->jsonResponse(["message" => "No allowed methods specified"], 405);
        }

        $method = $_SERVER["REQUEST_METHOD"];
        if(!in_array($method, $this->allowedMethods, true)) {
            $this->jsonResponse(["message" => "Method not allowed"], 405);
        }

        if (!$this->isOriginAllowed($this->host)) {
            $this->jsonResponse(["message" => "Method not allowed from this origin"], 405);
        }

        $this->$method();
    }


    abstract public function get();
    abstract public function post();
    abstract public function put();
    abstract public function delete();

     // create method options() to handle the OPTIONS request
    public function options(){
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type");
            header("Access-Control-Allow-Origin: *");
    }

}