<?php

namespace App\Domain\Pricing\Rules;

use App\Domain\Pricing\PricingRule;
use App\Dto\ValuationRequest;

class SeasonRule implements PricingRule
{
    public function __construct(
        private float $bonus = 10.0
    ) {
    }

    public function supports(ValuationRequest $request): bool
    {
        return $request->isHighSeason;
    }

    public function apply(ValuationRequest $request, float $currentPrice): float
    {
        return $currentPrice + $this->bonus;
    }
}