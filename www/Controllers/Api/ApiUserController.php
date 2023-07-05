<?php 
namespace App\Controllers\Api;


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

        if(count($_POST) !== 5){
            $this->jsonResponse(["message" => "Tous les champs sont obligatoires"], 400);
        }

        if(empty($_POST["email"]) ||
            empty($_POST["firstname"]) ||
            empty($_POST["lastname"]) ||
            empty($_POST["password"]) ||
            empty($_POST["password_confirm"])) {
            $this->jsonResponse(["message" => "Certains champs sont manquants"], 400);
        }

        extract($_POST);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->jsonResponse(["message" => "L'email n'est pas valide"], 400);
        }

        if(strlen($password) < 8){
            $this->jsonResponse(["message" => "Le mot de passe doit contenir au moins 8 caractères"], 400);
        }

        if (!preg_match("#[0-9]+#", $password)) {
            $this->jsonResponse(["message" => "Le mot de passe doit contenir au moins 1 chiffre"], 400);
        }

        if($password !== $password_confirm) {
            $this->jsonResponse(["message" => "Les mots de passe ne correspondent pas"], 400);
        }

        $this->user->setEmail($email);
        $this->user->setFirstname($firstname);
        $this->user->setLastname($lastname);
        $this->user->setPwd($password);

        if($this->repository->findByEmail($this->user)){
            $this->jsonResponse(["message" => "L'utilisateur existe déjà"], 400);
        }

        try{
            $this->repository->addUserByApi($this->user);
        } catch (\Exception $e){
            $this->jsonResponse(["message" => "Une erreur est survenue lors de la création de l'utilisateur",], 500);
        }
        $this->jsonResponse(["message" => "Utilisateur créé avec succès"], 201);
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