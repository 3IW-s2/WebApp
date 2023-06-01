<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Core\Database;
use App\Core\Error;
use App\Core\Security;

class UserService extends Database 
{
    private $userRepo;
    private $error;
    protected $checkConnexion;
    
    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->error = new Error();
/*         $this->checkConnexion = new Security();
 */    }

    public function registerUser(string $firstname, string $lastname, string $email, string $password, ?string $role = null): bool
    {
    $userCreated = $this->userRepo->register($firstname, $lastname, $email, $password, $role);

    try {
        if ($userCreated) {
            return true;
        } else {
            $this->error->addError("Une erreur s'est produite lors de l'enregistrement de l'utilisateur");
            return false;
        }
    } catch (\Exception $e) {

        return false;
    }

    }

    public function getAllUser(): array
    {
        return $this->userRepo->allUser();
    }

    public function getUserById( User $user)
    {
    
       return  $this->userRepo->getUserById($user);
     
    }

    public function updateUser ( User $user): bool
    {
         if ($this->userRepo->updateUser($user)) {
            return true;
        } else {
            $this->error->addError("Une erreur s'est produite lors de la mise à jour de l'utilisateur");
            return false;
        }
    }
    
    public function deleteUserById( User $user): void
    {
        $this->userRepo->deleteUserById($user);
    }

    public function addUser(User $user): bool
    {
        if ($this->userRepo->addUser($user)) {
            return true;
        } else {
            $this->error->addError("Une erreur s'est produite lors de l'ajout de l'utilisateur");
            return false;
        }
    }

    public function getUserByEmail(User $user): void
    {
         $this->userRepo->getUserByEmail($user);
    }

}
