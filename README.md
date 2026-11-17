# Faker PHP — pt_BR locale

Brazilian Portuguese (`pt_BR`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-pt-br
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('pt_BR');

$faker->name();
$faker->fullAddress();
$faker->cpf();
```

The package provides `pt_BR` variants of the address, colors, company, financial, person, phone and text
extensions. Generators without a `pt_BR` variant fall back to the default locale.

### Locale-specific generators

| Method | Extension | Description |
| --- | --- | --- |
| `cpf()` | `PersonExtension` | CPF with valid check digits, `000.000.000-00` (pass `false` for digits only) |
| `cnpj()` | `CompanyExtension` | CNPJ with valid check digits, `00.000.000/0001-00` (pass `false` for digits only) |
| `state()` | `AddressExtension` | State keyed by its UF code, e.g. `['SP' => 'São Paulo']` |
| `postcode()` | `AddressExtension` | CEP in the `00000-000` format |
| `iban()` | `FinancialExtension` | Brazilian IBAN (`BR`, 29 characters) |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add or update an extension under `src/Extensions/` and register it in `FakerPtBrServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
