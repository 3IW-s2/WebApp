<?php 
namespace App\Controllers\Api;


use App\Core\Configuration\Configuration;
use App\Core\Error;
use App\Models\User;
use App\Repositories\UserRepository;

class ApiUserController extends Api{

    private User $user;
    private UserRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User(new Error());
        // Default values (role 5 = user, status 0 = inactive)
        $this->user->setRole(5);
        $this->user->setStatus(0);

        $this->repository = new UserRepository();
    }

    /**
     * Method used in installer to create the first user (as admin)
     * @return void
     */
    private function initialize(): void {
        if(!isset($_POST["appName"])){
            $this->jsonResponse(["message" => "Le nom de l'application est obligatoire", "success" => false], 400);
        }
        Configuration::setConfig("APP_NAME", "\"".$_POST["appName"]."\"");

        $this->user->setRole(1);
        $this->user->setStatus(1);
    }
    public function get(){
        $this->jsonResponse(['message' => 'GET Method not implemented'], 405);
    }

    public function post()
    {
        $users = $this->repository->findAll();

        /*
         * If there is no user in the database
         * Initialize the first user as admin (installer)
         */
        if (empty($users)) {
            $this->initialize();
        }

        if(count($_POST) !== (5 + (int)empty($users))){
            $this->jsonResponse(["message" => "Tous les champs sont obligatoires", "success" => false], 400);
        }

        if(empty($_POST["email"]) ||
            empty($_POST["firstname"]) ||
            empty($_POST["lastname"]) ||
            empty($_POST["password"]) ||
            empty($_POST["passwordConfirmation"])) {
            $this->jsonResponse(["message" => "Certains champs sont manquants", "success" => false], 400);
        }

        extract($_POST);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->jsonResponse(["message" => "L'email n'est pas valide"], 400);
        }

        if(strlen($password) < 8){
            $this->jsonResponse(["message" => "Le mot de passe doit contenir au moins 8 caractères", "success" => false], 400);
        }

        if (!preg_match("#[0-9]+#", $password)) {
            $this->jsonResponse(["message" => "Le mot de passe doit contenir au moins 1 chiffre", "success" => false], 400);
        }

        if($password !== $passwordConfirmation) {
            $this->jsonResponse(["message" => "Les mots de passe ne correspondent pas", "success" => false], 400);
        }

        $this->user->setEmail($email);
        $this->user->setFirstname($firstname);
        $this->user->setLastname($lastname);
        $this->user->setPwd($password);

        if($this->repository->findByEmail($this->user)){
            $this->jsonResponse(["message" => "L'utilisateur existe déjà", "success" => false], 400);
        }

        try{
            $this->repository->addUserByApi($this->user);
        } catch (\Exception $e){
            $this->jsonResponse(["message" => "Une erreur est survenue lors de la création de l'utilisateur", "success" => false], 500);
        }
        Configuration::setConfig("INSTALLER_MODE", "false");
        $this->jsonResponse(["message" => "Utilisateur créé avec succès", "success" => true], 201);
    }

    public function put()
    {
        $this->jsonResponse(['message' => 'PUT Method not implemented'], 405);
    }

    public function delete()
    {
        $this->jsonResponse(['message' => 'DELETE Method not implemented'], 405);
    }
}