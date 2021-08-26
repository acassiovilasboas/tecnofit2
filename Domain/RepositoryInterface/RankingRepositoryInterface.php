<?php

namespace Domain\Services\RepositoryInterface;


interface RankingRepositoryInterface
{
    public function showRankingForMovement(int $id);
    public function showRankingForUser(int $id);
}