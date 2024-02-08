# PHP SDK for e-conomic with WordPress support

[![Latest Version on Packagist](https://img.shields.io/packagist/v/morningtrain/morning-trian-wp-e-conomic.svg?style=flat-square)](https://packagist.org/packages/morningtrain/morning-trian-wp-e-conomic)
[![Tests](https://img.shields.io/github/actions/workflow/status/morningtrain/morning-trian-wp-e-conomic/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/morningtrain/morning-trian-wp-e-conomic/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/morningtrain/morning-trian-wp-e-conomic.svg?style=flat-square)](https://packagist.org/packages/morningtrain/morning-trian-wp-e-conomic)

This creates a wrapper for the e-conomic REST API using [morningtrain/economic package](https://github.com/Morning-Train/economic), and makes it easy to use in a WordPress application.

## Installation

You can install the package via composer:

```bash
composer require morningtrain/wp-economic
```

## Usage

```php
    use MorningTrain\WordPress\Economic\Economic;

    Economic::setup(
    ECONOMIC_APP_SECRET_TOKEN,
    ECONOMIC_GRANT_TOKEN);
    
    Economic::useLogger(new fooLogger());
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Martin Schadegg Brønniche](https://github.com/mschadegg)
- [Lars Rasmussen](https://github.com/larasmorningtrain)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
