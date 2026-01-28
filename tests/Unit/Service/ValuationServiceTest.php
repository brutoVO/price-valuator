<?php

namespace App\Tests\Unit\Service;

use App\Domain\Pricing\PricingRule;
use App\Dto\ValuationRequest;
use App\Service\ValuationService;
use PHPUnit\Framework\TestCase;

class ValuationServiceTest extends TestCase
{
    public function testItReturnsABasePriceValuation(): void
    {
        $request = new ValuationRequest('Zara', 'shirt', 'good');
        $service = new ValuationService([]);

        $result = $service->estimate($request);

        $this->assertEquals(10.0, $result->getEstimatedPrice());
    }

    public function testItAppliesPricingRules(): void
    {
        $request = new ValuationRequest('Zara', 'shirt', 'good');
        
        $ruleMock = $this->createMock(PricingRule::class);
        $ruleMock->method('supports')->willReturn(true);
        $ruleMock->method('apply')->willReturn(15.0);

        $service = new ValuationService([$ruleMock]);

        $result = $service->estimate($request);

        $this->assertEquals(15.0, $result->getEstimatedPrice());
    }
}
