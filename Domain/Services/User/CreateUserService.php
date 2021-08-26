<?php

namespace Domain\Services\Users;

use Domain\Services\Entities\UserEntity;
use Domain\Services\RepositoryInterface\UserRepositoryInterface;
use Error;

class CreateUserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserEntity $user)
    {
        if($user->name === "ACASSIO")
            throw (new Error("Nome errado"));
        return $this->userRepository->create($user);
    }
}