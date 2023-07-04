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
    private $userRepo;

    public function __construct()
    {
        $this->httpError = new httpError();
        $this->loadConfig();
        $this->httpError->httpOriginError($this->host);
        $this->userRepo = new UserRepository();
    }

    private function loadConfig() {
        $configFile = __DIR__ . '/../../config.yml';
        $config = yaml_parse_file($configFile);

        $this->host = $config['origin'];
    }


    public function getUser()
    {   
  
        $this->httpError->httpError("GET");
        if(isset($_GET['email'])){
            $user = new UserRepository();
            $userModel = new User( new Error());
            $userModel->setEmail($_GET['email']);
            $user = $user->findByEmail($userModel);
            if(empty($user)){
                http_response_code(404);
                echo json_encode(['message' => 'User not found']);
                exit();
            }
            echo json_encode($user);
            exit();
        }
        $user = new UserRepository();
        $users = $user->findAll();       
        echo json_encode($users);
    }

    public function deleteUser()
    {   
            $this->httpError->httpError("DELETE");
            http_response_code(207);
            $user = new UserRepository();
            $userModel = new User( new Error());
            $userModel->setId($_GET['id']);
            $user->deleteUserByIdHard($userModel);
    } 

    public function addUser()
    {
        $this->httpError->httpError("POST");
        $userAll = $this->userRepo->findAll();
        $userModel = new User( new Error());
        if(empty($userAll)){
            $userModel->setEmail($_POST['email']);
            $userModel->setFirstname($_POST['firstname']);
            $userModel->setLastname($_POST['lastname']);
            $userModel->setRole(intval("1"));
            $userModel->setStatus("1");
            $userModel->setPwd($_POST['password']);
            $this->userRepo->addUserByApi($userModel);
            exit();
        }
        foreach($userAll as $user){
            $email = $user['email'];
            if($email === $_POST['email']){
                http_response_code(409);
                echo json_encode(['message' => 'User already exist']);
                exit();
            }
        }
        $userModel->setEmail($_POST['email']);
        $userModel->setFirstname($_POST['firstname']);
        $userModel->setLastname($_POST['lastname']);
        $userModel->setRole(intval("5"));
        $userModel->setStatus("1");
        $userModel->setPwd($_POST['password']);
        $this->userRepo->addUserByApi($userModel);
        echo(json_encode(['message' => 'User added']));

       
    }

    public function connexion()
    {
        $this->httpError->httpError("POST");
        $userModel = new User( new Error());
        $userModel->setEmail($_POST['email']);
        $userModel->setPwd($_POST['password']);
        $user = $this->userRepo->findByEmail($userModel);
        if($user && password_verify($_POST['password'], $user['password'])){
            echo json_encode($user);
            exit();
        }
        http_response_code(401);
        echo json_encode(['message' => 'User not found']);
    }
}