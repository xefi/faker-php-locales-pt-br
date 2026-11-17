<?php

namespace Xefi\Faker\PtBr\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtBr\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing($this->companies, $results);
    }

    public function testCnpjIsFormattedWithValidCheckDigits(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $cnpj = $this->faker->cnpj();

            $this->assertMatchesRegularExpression('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $cnpj);
            $this->assertTrue($this->isValidCnpj(preg_replace('/\D/', '', $cnpj)), "CNPJ '{$cnpj}' has invalid check digits.");
        }
    }

    public function testCnpjUnformattedHasValidCheckDigits(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $cnpj = $this->faker->cnpj(false);

            $this->assertMatchesRegularExpression('/^\d{14}$/', $cnpj);
            $this->assertTrue($this->isValidCnpj($cnpj), "CNPJ '{$cnpj}' has invalid check digits.");
        }
    }

    public function testKnownCnpjIsValid(): void
    {
        $this->assertTrue($this->isValidCnpj('11222333000181'));
        $this->assertFalse($this->isValidCnpj('11222333000182'));
    }

    private function isValidCnpj(string $cnpj): bool
    {
        if (strlen($cnpj) !== 14) {
            return false;
        }

        foreach ([12, 13] as $length) {
            $sum = 0;
            $weight = $length - 7;
            for ($i = 0; $i < $length; $i++) {
                $sum += (int) $cnpj[$i] * $weight;
                $weight = $weight === 2 ? 9 : $weight - 1;
            }
            $remainder = $sum % 11;
            $check = $remainder < 2 ? 0 : 11 - $remainder;

            if ($check !== (int) $cnpj[$length]) {
                return false;
            }
        }

        return true;
    }
}
