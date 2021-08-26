<?php

namespace Domain\Services\Infra\Data\MySQL\Repository;


use Domain\Services\Entities\UserEntity;
use Domain\Services\RepositoryInterface\UserRepositoryInterface;
use Error;
use PDO;
use \PDOException;

class UserRepository implements UserRepositoryInterface
{
    protected ?PDO $db;

    public function __construct(?PDO $database)
    {
        $this->db = $database;
    }

    public function index(int $id)
    {
        try {
            $query = "SELECT * FROM user WHERE id=:id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            return new UserEntity($data->id, $data->name);
        } catch (Error $e) {
            new Error("Deu ruim no PDO ");
            return null;
        }
    }

    public function show()
    {
        try {
            $query = "SELECT * FROM user";
            $data['users'] = $this->db->query($query)
                ->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function create(UserEntity $user)
    {
        try {
            $query = "INSERT INTO user (name) VALUES (:name)";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['name' => $user->name]);

            return $this->index($this->db->lastInsertId());
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update(int $id)
    {
        return null;
        // TODO: Implement update() method.
    }
}
