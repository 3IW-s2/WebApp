<?php
namespace App\Services;


class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->findById($id);
    }
}
