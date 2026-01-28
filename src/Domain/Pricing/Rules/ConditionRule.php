<?php

namespace App\Domain\Pricing\Rules;

use App\Domain\Pricing\PricingRule;
use App\Dto\ValuationRequest;

class ConditionRule implements PricingRule
{
	private const DEFAULT_MULTIPLIERS = [
		'new' => 1.5,
		'good' => 1.2,
		'fair' => 1.0,
	];

	/**
	 * @param array<string, float> $conditionMultipliers
	 */
	public function __construct(
		private array $conditionMultipliers = self::DEFAULT_MULTIPLIERS
	) {
	}

	public function supports(ValuationRequest $request): bool
	{
		return array_key_exists(strtolower($request->condition), $this->conditionMultipliers);
	}

	public function apply(ValuationRequest $request, float $currentPrice): float
	{
		$multiplier = $this->conditionMultipliers[strtolower($request->condition)];

		return $currentPrice * $multiplier;
	}
}
