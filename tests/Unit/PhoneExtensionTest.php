<?php

namespace Xefi\Faker\PtBr\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-9]{2}(9\d{8}|[2-5]\d{7})$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-9]{2}9\d{8}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testSpacedLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-9]{2} [2-5]\d{3} \d{4}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+55[1-9]{2}(9\d{8}|[2-5]\d{7})$/', $this->faker->indicatoredPhoneNumber());
        }
    }

    public function testSpacedIndicatoredCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+55 [1-9]{2} 9\d{4} \d{4}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
        }
    }

    public function testIndicatorIsSeparatedFromTheNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertStringStartsWith('+55 ', $this->faker->spacedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+55-', $this->faker->dashedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+55.', $this->faker->dottedIndicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+55\d+$/', $this->faker->indicatoredPhoneNumber());
        }
    }
}
