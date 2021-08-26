<?php


namespace App\Controllers;


class Movement
{
    public function index()
    {
//       header comentado para rodar os testes
//       header('Content-type: application/json');

        $movement = (new \App\Models\Movement())->find()->order('id')->fetch(true);

        if(empty($movement)){
            http_response_code(400);
            echo json_encode(array(
                "status" => "error",
                "message" => "não existe exercícios cadastros na base de dados"),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

      
        $response = [];
        foreach($movement as $m)
            $response[] = $m->data();
        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "data" => $response),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $movement;
    }

    public function findById(array $data)
    {
//       header comentado para rodar os testes
//       header('Content-type: application/json');

        if (!empty($data['id'])) {
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
            $movement = (new \App\Models\Movement())->findById($id);

            if (empty($movement)) {
                http_response_code(400);
                echo json_encode(array(
                    "status" => "error",
                    "message" => "identificador inválido"),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return false;
            }

            $response = $movement->data();
            http_response_code(200);
            echo json_encode(array(
                "status" => "success",
                "data" => $response),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return $response;
        }

        http_response_code(400);
        echo json_encode(array(
            "status" => "error",
            "message" => "não foi possivel buscar o exercício"),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return false;
    }
}