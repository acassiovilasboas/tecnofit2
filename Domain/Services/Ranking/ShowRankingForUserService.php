<?php

namespace Domain\Services\Ranking;

use Domain\Services\RepositoryInterface\RankingRepositoryInterface;

class ShowRankingForUserService
{
	private RankingRepositoryInterface $rankingRepository;

	public function __construct(RankingRepositoryInterface $rankingRepositoryInterface)
	{
		$this->rankingRepository = $rankingRepositoryInterface;
	}

	public function execute(int $id)
	{
		return $this->rankingRepository->showRankingForUser($id);
	}

}
