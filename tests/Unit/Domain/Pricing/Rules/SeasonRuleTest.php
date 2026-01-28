<?php

namespace App\Tests\Unit\Domain\Pricing\Rules;

use App\Domain\Pricing\Rules\SeasonRule;
use App\Dto\ValuationRequest;
use PHPUnit\Framework\TestCase;

class SeasonRuleTest extends TestCase
{
    public function testItAddsBonusWhenHighSeasonIsFlagged(): void
    {
        $rule = new SeasonRule(bonus: 5.0);
        $request = new ValuationRequest('Any', 'Any', isHighSeason: true);

        $this->assertTrue($rule->supports($request));
        $this->assertEquals(105.0, $rule->apply($request, 100.0));
    }

    public function testItDoesNotAddBonusWhenNotHighSeason(): void
    {
        $rule = new SeasonRule(bonus: 5.0);
        $request = new ValuationRequest('Any', 'Any', isHighSeason: false);

        $this->assertFalse($rule->supports($request));
    }
}
