<?php

namespace App\Tests\Unit\Domain\Pricing\Rules;

use App\Domain\Pricing\Rules\ConditionRule;
use App\Dto\ValuationRequest;
use PHPUnit\Framework\TestCase;

class ConditionRuleTest extends TestCase
{
    private ConditionRule $rule;

    protected function setUp(): void
    {
        $this->rule = new ConditionRule([
            'new' => 1.5,
            'good' => 1.2
        ]);
    }

    public function testItSupportsConfiguredConditions(): void
    {
        $this->assertTrue($this->rule->supports(new ValuationRequest('Any', 'new')));
        $this->assertTrue($this->rule->supports(new ValuationRequest('Any', 'good')));
    }

    public function testItDoesNotSupportUnknownConditions(): void
    {
        $this->assertFalse($this->rule->supports(new ValuationRequest('Any', 'bad')));
    }

    public function testItAppliesCorrectMultiplier(): void
    {
        $newRequest = new ValuationRequest('Any', 'new');
        $goodRequest = new ValuationRequest('Any', 'good');
        
        $this->assertEqualsWithDelta(15.0, $this->rule->apply($newRequest, 10.0), 0.001);
        $this->assertEqualsWithDelta(12.0, $this->rule->apply($goodRequest, 10.0), 0.001);
    }
}
