<?php


namespace App\Controllers;


class Ranking
{
    public function index()
    {
        $ranking = (new \App\Models\PersonalRecord())->rankingAllUser();

//      header comentado para rodar os testesddddddddddddd
//      header('Content-type: application/json');

        if(empty($ranking)) {
            http_response_code(400);
            echo json_encode(array(
                "status" => "error",
                "message" => "não existe alunos cadastrados na base de dados"),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "data" => $ranking),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $ranking;
    }


    public function findUserById(array $data)
    {
        $ranking = (new \App\Models\PersonalRecord())->rankingByUser($data['id']);

//      header comentado para rodar os testesddddddddddddd
//      header('Content-type: application/json');

        if(empty($ranking)) {
            http_response_code(400);
            echo json_encode(array(
                "status" => "error",
                "message" => "aluno inexistente"),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "data" => $ranking),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $ranking;
    }


    public function findMovementById(array $data)
    {
        $ranking = (new \App\Models\PersonalRecord())->rankingByMoviment($data['id']);

//      header comentado para rodar os testesddddddddddddd
//      header('Content-type: application/json');

        if(empty($ranking)) {
            http_response_code(400);
            echo json_encode(array(
                "status" => "error",
                "message" => "exercício inexistente"),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "data" => $ranking),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $ranking;
    }
}