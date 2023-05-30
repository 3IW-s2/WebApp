<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Core\Database;
use App\Core\Error;

class UserService extends Database 
{
    private $userRepo;
    private $error;
    
    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->error = new Error();
    }

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

    public function getUserById(int $id): ?User
    {
        return $this->userRepo->getUserById($id);
    }

    public function updateUser ( User $user)
    {
        return $this->userRepo->updateUser($user);
    }
    
    public function deleteUserById( User $user): void
    {
        $this->userRepo->deleteUserById($user);
    }

}
