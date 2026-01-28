<?php

namespace App\Dto;

readonly class ValuationResponse
{
	public function __construct(
		private float $estimatedPrice
	) {
	}

	public function getEstimatedPrice(): float
	{
		return $this->estimatedPrice;
	}
}
