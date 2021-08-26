<?php


namespace App\Controllers;


class User
{
    public function index()
    {
        //       header comentado para rodar os testes
        //       header('Content-type: application/json');

        $users = (new \App\Models\User())->find()->order('id')->fetch(true);

        if (empty($users)) {
            http_response_code(400);
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => "não existe categorias cadastradas na base de dados"
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
            return false;
        }

        $response = [];
        foreach ($users as $c)
            $response[] = $c->data();
        http_response_code(200);
        echo json_encode(
            array(
                "status" => "success",
                "data" => $response
            ),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    public function findById(array $data)
    {
        //       header comentado para rodar os testes
        //       header('Content-type: application/json');

        if (!empty($data['id'])) {
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
            $user = (new \App\Models\User())->findById($id);

            if (empty($user)) {
                http_response_code(400);
                echo json_encode(
                    array(
                        "status" => "error",
                        "message" => "identificador inválido"
                    ),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );
                return false;
            }

            $response = $user->data();
            http_response_code(200);
            echo json_encode(
                array(
                    "status" => "success",
                    "data" => $response
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
            return $response;
        }

        http_response_code(400);
        echo json_encode(
            array(
                "status" => "error",
                "message" => "não foi possivel buscar o usuário"
            ),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return false;
    }
}
