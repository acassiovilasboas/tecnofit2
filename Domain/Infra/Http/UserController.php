<?php
namespace Domain\Services\Infra\Http;

use Domain\Services\Entities\UserEntity;
use Domain\Services\Infra\Data\MySQL\Database;
use Domain\Services\Infra\Data\MySQL\Repository\UserRepository;
use Domain\Services\RepositoryInterface\UserRepositoryInterface;
use Domain\Services\Users\CreateUserService;
use Domain\Services\Users\IndexUserService;
use Domain\Services\Users\ShowUserService;
use Error;

class UserController
{
    protected UserRepositoryInterface $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getInstance());
    }

    public function index(array $data)
    {        
            try{ 
                $serive = new IndexUserService($this->userRepository);
                $user = $serive->excute($data['id']);

                http_response_code(200);
                echo json_encode(
                    array(
                        "status" => "success",
                        "data" => $user
                    ),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );
            }catch (Error $error){
                http_response_code(500);
                echo json_encode(
                    array(
                        "status" => "error",
                        "message" => $error->getMessage(). " - ".$error->getFile().":".$error->getLine()
                    ),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );
            }
            return;
    }

    public function show()
    {
        try {
            $service = new ShowUserService($this->userRepository);
            $user = $service->execute();
            http_response_code(200);
                echo json_encode(
                    array(
                        "status" => "success",
                        "data" => $user
                    ),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );
        } catch (Error $error) {
            http_response_code(500);
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => $error->getMessage(). " - ".$error->getFile().":".$error->getLine()
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
        return;
    }

    public function create(array $data)
    {
        try{        
            $service = new CreateUserService($this->userRepository);
            $user = new UserEntity(null, $data['name']);
            $newUser = $service->execute($user);
            http_response_code(200);
            echo json_encode(
                array(
                    "status" => "success",
                    "data" => $newUser
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }catch (Error $error){
            http_response_code(500);
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => $error->getMessage(). " - ".$error->getFile().":".$error->getLine()
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
        return;
    }

    public function update(int $id)
    {
        // TODO: Implement update() method.
    }
}