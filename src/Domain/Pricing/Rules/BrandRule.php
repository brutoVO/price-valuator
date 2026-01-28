<?php

namespace App\Domain\Pricing\Rules;

use App\Domain\Pricing\PricingRule;
use App\Dto\ValuationRequest;

class BrandRule implements PricingRule
{
	private const DEFAULT_BONUSES = [
		'zara' => 1.10,
		'primark' => 1.05,
		'mango' => 1.08,
	];

	/**
	 * @param array<string, float> $brandBonuses
	 */
	public function __construct(
		private array $brandBonuses = self::DEFAULT_BONUSES
	) {
	}

	public function supports(ValuationRequest $request): bool
	{
		return array_key_exists(strtolower($request->brand), $this->brandBonuses);
	}

	public function apply(ValuationRequest $request, float $currentPrice): float
	{
		$multiplier = $this->brandBonuses[strtolower($request->brand)];

		return $currentPrice * $multiplier;
	}
}
