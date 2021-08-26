<?php

namespace Domain\Services\Users;

use Domain\Services\RepositoryInterface\UserRepositoryInterface;
use Error;
use PHPUnit\Framework\Error\Warning;


class IndexUserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function excute(int $id)
    {
        $user = $this->userRepository->index($id);
        if(empty($user->id)) {
            throw(new Error('Usuário não encontrado'));
        }
        return $user;
    }
}