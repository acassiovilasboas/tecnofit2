<?php

namespace Domain\Services\Entities;

class UserEntity
{
    public ?string $id;
    public string $name;

    public function __construct(?string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}