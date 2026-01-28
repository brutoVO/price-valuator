<?php

namespace App\Dto;

readonly class ValuationRequest
{
	public function __construct(
		public string $brand,
		public string $category,
		public string $condition
	) {
	}
}
