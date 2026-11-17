<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_BR';
    }

    /**
     * Generate a Brazilian IBAN (bank ISPB, branch, account, account type and holder position).
     *
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'BR';
        }

        if ($format === null) {
            $format = sprintf(
                '%s%s%s%s%s',
                str_repeat('{d}', 8),
                str_repeat('{d}', 5),
                str_repeat('{d}', 10),
                $this->pickArrayRandomElement(['C', 'P']),
                '{d}'
            );
        }

        return parent::iban($countryCode, $format);
    }
}
