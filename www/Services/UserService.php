<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private $userRepo;
    
    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function registerUser(string $firstname, string $lastname, string $email, string $password, ?string $role = null): bool
    {
    $userCreated = $this->userRepo->register($firstname, $lastname, $email, $password, $role);

    if ($userCreated) {
        return true;
    } else {
        return false;
    }
}

}
