<?php
namespace App\Domain\Pricing;

use App\Dto\ValuationRequest;

interface PricingRule
{
	public function supports(ValuationRequest $request): bool;

	public function apply(
		ValuationRequest $request,
		float $currentPrice
	): float;

}
