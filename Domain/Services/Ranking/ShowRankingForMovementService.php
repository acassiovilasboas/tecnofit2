<?php

namespace Domain\Services\Ranking;

use Domain\Services\RepositoryInterface\RankingRepositoryInterface;
use Error;
use Exception;

use function PHPUnit\Framework\throwException;

class ShowRankingForMovementService
{
	protected RankingRepositoryInterface $rankingRepository;

	public function __construct(RankingRepositoryInterface $rankingRepository)
	{
		$this->rankingRepository = $rankingRepository;
	}

	public function execute(int $id)
	{
		$ranking = $this->rankingRepository->showRankingForMovement($id);
		if (empty($ranking)) {
			throw (new Exception("return empty", 204));
		}
		return $ranking;
	}

}
