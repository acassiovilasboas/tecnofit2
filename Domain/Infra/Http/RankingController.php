<?php

namespace Domain\Services\Infra\Http;

use Domain\Services\Infra\Data\MySQL\Database;
use Domain\Services\Infra\Data\MySQL\Repository\RankingRepository;
use Domain\Services\Ranking\ShowRankingForMovementService;
use Domain\Services\Ranking\ShowRankingForUserService;
use Domain\Services\RepositoryInterface\RankingRepositoryInterface;
use Error;
use Exception;

class RankingController
{
    protected RankingRepositoryInterface $rankingRepository;

    public function __construct()
    {
        $this->rankingRepository = new RankingRepository(Database::getInstance());
    }

    public function showRankingForMovement(array $data)
    {
        try {
            $serive = new ShowRankingForMovementService($this->rankingRepository);
            $ranking = $serive->execute($data['id']);

            http_response_code(200);
            echo json_encode(
                array(
                    "status" => "success",
                    "data" => $ranking
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        } catch (Exception $error) {
            http_response_code($error->getCode());
        } catch (Error $error) {
            http_response_code(500);
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => $error->getMessage()
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function showRankingForUser(array $data)
    {
        try {
            $serive = new ShowRankingForUserService($this->rankingRepository);
            $ranking = $serive->execute($data['id']);

            http_response_code(200);
            echo json_encode(
                array(
                    "status" => "success",
                    "data" => $ranking
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        } catch (Error $error) {
            http_response_code(500);
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => $error->getMessage() . " - " . $error->getFile() . ":" . $error->getLine()
                ),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
    }
}
