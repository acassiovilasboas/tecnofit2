<?php

namespace Domain\Services\Users;

use Domain\Services\RepositoryInterface\UserRepositoryInterface;

class ShowUserService
{
	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository) 
	{
		$this->userRepository = $userRepository;
	}

	public function execute()
	{	
		return $this->userRepository->show();
	}
}