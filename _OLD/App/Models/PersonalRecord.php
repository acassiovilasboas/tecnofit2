<?php


namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;



class PersonalRecord extends DataLayer
{

    public function __construct()
    {
        parent::__construct("personal_record", []);
    }


    public function rankingAllUser()
    {
        $query = "
            SELECT
                user.name as user,
                mo.name as movement,
                pr.value,
                pr.date,
                RANK() OVER(
                    PARTITION BY mo.id
                    ORDER BY pr.value DESC
                ) as ranking
            FROM user
            INNER JOIN personal_record as pr ON pr.user_id = user.id
            INNER JOIN movement as mo ON mo.id = pr.movement_id
            GROUP BY user.id, mo.id
            ORDER BY mo.id
        ";
        $connect = Connect::getInstance();
        $stmt = $connect->query($query);
        return $stmt->fetchAll();
    }


    public function rankingByUser(int $id)
    {
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
            WHERE user.id=:id
            ";
        $connect = Connect::getInstance();
        $stmt = $connect->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }


    public function rankingByMoviment(int $id)
    {
        $query = "
                SELECT
                    user.name as user,
                    mo.name as movement,
                    pr.value,
                    pr.date,
                    RANK() OVER(
                    -- 	PARTITION BY mo.name
                        ORDER BY pr.value DESC
                    ) as ranking
                FROM movement mo
                INNER JOIN personal_record as pr ON pr.movement_id = mo.id
                INNER JOIN user ON user.id = pr.user_id
                WHERE mo.id=:id
                GROUP BY user.id
                ";
        $connect = Connect::getInstance();
        $stmt = $connect->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }
}
