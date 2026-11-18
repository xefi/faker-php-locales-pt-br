<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+55';

    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_BR';
    }

    protected array $landlineFormats = [
        '11{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '11{separator}2{d}{d}{d}{separator}{d}{d}{d}{d}',
        '21{separator}2{d}{d}{d}{separator}{d}{d}{d}{d}',
        '21{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '31{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '41{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '51{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '61{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '71{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '81{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '85{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
        '92{separator}3{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '11{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '21{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '31{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '41{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '48{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '51{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '61{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '62{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '71{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '81{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '85{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '91{separator}9{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    /**
     * Generate a phone number, keeping a separator between the indicator and the number.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
