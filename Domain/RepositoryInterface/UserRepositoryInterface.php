<?php

namespace Domain\Services\RepositoryInterface;

use Domain\Services\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function index(int $id);
    public function show();
    public function create(UserEntity $user);
}