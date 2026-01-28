<?php

namespace App\Service;

use App\Domain\Pricing\PricingRule;
use App\Dto\ValuationRequest;
use App\Dto\ValuationResponse;

class ValuationService
{
	/**
	 * @param iterable<PricingRule> $rules
	 */
	public function __construct(private iterable $rules)
	{
	}

	public function estimate(ValuationRequest $request): ValuationResponse
	{
		$price = 10.0;

		foreach ($this->rules as $rule) {
			if ($rule->supports($request)) {
				$price = $rule->apply($request, $price);
			}
		}

		return new ValuationResponse($price);
	}

}
