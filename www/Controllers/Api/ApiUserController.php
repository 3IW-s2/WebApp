<?php 
namespace App\Controllers\Api;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Core\Error;
use App\Core\httpError;


class ApiUserController
{
    private $httpError;
    private $host;

    public function __construct()
    {
        $this->httpError = new httpError();
        $this->loadConfig();
        $this->httpError->httpOriginError($this->host);
    }

    private function loadConfig() {
        $configFile = __DIR__ . '/../../config.yml';
        $config = yaml_parse_file($configFile);

        $this->host = $config['origin'];
    }


    public function getUser()
    {   
        $this->httpError->httpError("GET");
        $user = new UserRepository();
        $users = $user->findAll();       
        echo json_encode($users);
    }

    public function deleteUser()
    {   
        $httpError = new httpError();
        $this->httpError->httpError("DELETE");
            http_response_code(207);
            $user = new UserRepository();
            $userModel = new User( new Error());
            $userModel->setId($_GET['id']);
            $user->deleteUserByIdHard($userModel);

       
    } 
}