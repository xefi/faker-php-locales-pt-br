<?php

namespace Xefi\Faker\PtBr\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtBr\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $regions = [];
    protected array $states = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($extension);

        $this->regions = $reflection->getProperty('regions')->getValue($extension);
        $this->states = $reflection->getProperty('states')->getValue($extension);
        $this->cities = $reflection->getProperty('cities')->getValue($extension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($extension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing($this->regions, $results);
    }

    public function testState(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $state = $this->faker->state();

            $this->assertContains($state, $this->states);
            $this->assertMatchesRegularExpression('/^[A-Z]{2}$/', array_key_first($state));
        }
    }

    public function testStatesCoverEveryUf(): void
    {
        $this->assertCount(27, $this->states);
        $this->assertCount(27, array_unique(array_map('array_key_first', $this->states)));
    }

    public function testCityStatesAreKnownUfs(): void
    {
        $ufs = array_map('array_key_first', $this->states);

        foreach ($this->cities as $uf) {
            $this->assertContains($uf, $ufs);
        }
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(array_keys($this->cities), $results);
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{5}-\d{3}$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(2999, $result);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$type, $name] = explode(' ', $this->faker->streetName(), 2);

            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[\p{L}\d ]+, \d{1,4}$/u', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^[\p{L}\d ]+, \d{1,4}, ([\p{L} ]+) - ([A-Z]{2}), \d{5}-\d{3}$/u', $result);

            preg_match('/, ([\p{L} ]+) - ([A-Z]{2}), /u', $result, $matches);
            $this->assertSame($this->cities[$matches[1]], $matches[2]);
        }
    }
}
