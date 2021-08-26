<?php

namespace Domain\Services\Infra\Data\MySQL\Repository;

use Domain\Services\Entities\MovementEntity;
use Domain\Services\Entities\UserEntity;
use Domain\Services\RepositoryInterface\RankingRepositoryInterface;
use Error;
use PDO;
use \PDOException;

class RankingRepository implements RankingRepositoryInterface
{
    protected ?PDO $db;

    public function __construct(?PDO $database)
    {
        $this->db = $database;
    }

    public function showRankingForMovement(int $id)
    {
        try {
            $query = "
            SELECT
                user.name as user,
                mo.name as movement,
                pr.value,
                pr.date,
                RANK() OVER(
                    PARTITION BY mo.name
                    ORDER BY pr.value DESC
                ) as ranking
                FROM movement mo
                INNER JOIN personal_record as pr ON pr.movement_id = mo.id
                INNER JOIN user ON user.id = pr.user_id
            WHERE mo.id=:id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $data;
        } catch (Error $e) {
            new Error("PDO error ");
            return null;
        }
    }

    public function showRankingForUser(int $id)
    {
        try {
            $query = "
            SELECT
                user.name as user,
                mo.name as movement,
                pr.value,
                pr.date,
                RANK() OVER(
                    PARTITION BY mo.name
                    ORDER BY pr.value DESC
                ) as ranking
                FROM movement mo
                INNER JOIN personal_record as pr ON pr.movement_id = mo.id
                INNER JOIN user ON user.id = pr.user_id
            WHERE user.id=:id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (Error $e) {
            new Error("PDO error ");
            return null;
        }
    }
}
