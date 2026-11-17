<?php

namespace Xefi\Faker\PtBr\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertEquals(29, strlen($iban));
            $this->assertMatchesRegularExpression('/^BR\d{2}\d{23}[CP]\d$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
        }
    }

    public function testIbanWithAnotherCountryCode(): void
    {
        $this->assertStringStartsWith('PT', $this->faker->iban('PT'));
    }
}
