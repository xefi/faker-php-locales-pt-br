<?php

namespace Xefi\Faker\PtBr\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\PtBr\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameFemale, $results);
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameMale, $results);
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing($firstNames, $results);
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing($this->lastName, $results);
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name());

            $this->assertContains($firstName, array_merge($this->firstNameMale, $this->firstNameFemale));
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameMale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE));

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE));

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->titleFemale, $results);
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->titleMale, $results);
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing($titles, $results);
    }

    public function testCpfIsFormattedWithValidCheckDigits(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $cpf = $this->faker->cpf();

            $this->assertMatchesRegularExpression('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf);
            $this->assertTrue($this->isValidCpf(preg_replace('/\D/', '', $cpf)), "CPF '{$cpf}' has invalid check digits.");
        }
    }

    public function testCpfUnformattedHasValidCheckDigits(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $cpf = $this->faker->cpf(false);

            $this->assertMatchesRegularExpression('/^\d{11}$/', $cpf);
            $this->assertTrue($this->isValidCpf($cpf), "CPF '{$cpf}' has invalid check digits.");
        }
    }

    public function testKnownCpfIsValid(): void
    {
        $this->assertTrue($this->isValidCpf('52998224725'));
        $this->assertFalse($this->isValidCpf('52998224726'));
    }

    private function isValidCpf(string $cpf): bool
    {
        if (strlen($cpf) !== 11 || count(array_unique(str_split($cpf))) === 1) {
            return false;
        }

        foreach ([9, 10] as $length) {
            $sum = 0;
            for ($i = 0; $i < $length; $i++) {
                $sum += (int) $cpf[$i] * ($length + 1 - $i);
            }
            $check = ($sum * 10) % 11 % 10;

            if ($check !== (int) $cpf[$length]) {
                return false;
            }
        }

        return true;
    }
}
