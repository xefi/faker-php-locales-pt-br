<?php

namespace Xefi\Faker\PtBr;

use Xefi\Faker\PtBr\Extensions\AddressExtension;
use Xefi\Faker\PtBr\Extensions\ColorsExtension;
use Xefi\Faker\PtBr\Extensions\CompanyExtension;
use Xefi\Faker\PtBr\Extensions\FinancialExtension;
use Xefi\Faker\PtBr\Extensions\PersonExtension;
use Xefi\Faker\PtBr\Extensions\PhoneExtension;
use Xefi\Faker\PtBr\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerPtBrServiceProvider extends Provider
{
    /**
     * Register the pt_BR extensions.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
