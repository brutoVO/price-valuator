<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ValuationRequest
{
	public function __construct(
		#[Assert\NotBlank]
		public string $brand,

		#[Assert\NotBlank]
		#[Assert\Choice(choices: ['new', 'good', 'fair'], message: 'The condition must be one of: new, good, fair.')]
		public string $condition,

		public bool $isHighSeason = false
	) {
	}
}
