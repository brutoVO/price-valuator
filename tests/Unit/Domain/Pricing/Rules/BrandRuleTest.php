<?php

namespace App\Tests\Unit\Domain\Pricing\Rules;

use App\Domain\Pricing\Rules\BrandRule;
use App\Dto\ValuationRequest;
use PHPUnit\Framework\TestCase;

class BrandRuleTest extends TestCase
{
    private BrandRule $rule;

    protected function setUp(): void
    {
        $this->rule = new BrandRule([
            'zara' => 1.10,
            'primark' => 1.05
        ]);
    }

    public function testItSupportsRegisteredBrands(): void
    {
        $this->assertTrue($this->rule->supports(new ValuationRequest('Zara', 'good')));
        $this->assertTrue($this->rule->supports(new ValuationRequest('Primark', 'good')));
    }

    public function testItDoesNotSupportUnknownBrands(): void
    {
        $this->assertFalse($this->rule->supports(new ValuationRequest('Nike', 'good')));
    }

    public function testItAddsCorrectBonusPerBrand(): void
    {
        $zaraRequest = new ValuationRequest('Zara', 'good');
        $primarkRequest = new ValuationRequest('Primark', 'good');
        
        $this->assertEqualsWithDelta(110.0, $this->rule->apply($zaraRequest, 100.0), 0.001);
        $this->assertEqualsWithDelta(105.0, $this->rule->apply($primarkRequest, 100.0), 0.001);
    }
}
