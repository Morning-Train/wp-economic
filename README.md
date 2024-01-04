# This is a integration for e-conomic to be use in a Wordpress application.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/morningtrain/morning-trian-wp-e-conomic.svg?style=flat-square)](https://packagist.org/packages/morningtrain/morning-trian-wp-e-conomic)
[![Tests](https://img.shields.io/github/actions/workflow/status/morningtrain/morning-trian-wp-e-conomic/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/morningtrain/morning-trian-wp-e-conomic/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/morningtrain/morning-trian-wp-e-conomic.svg?style=flat-square)](https://packagist.org/packages/morningtrain/morning-trian-wp-e-conomic)

This create a wrapper for the e-conomic api using [e-conomic package](https://github.com/Morning-Train/e-conomic), and makes it easy to use in a Wordpress application.

## Installation

You can install the package via composer:

```bash
composer require morningtrain/wp-e-conomic
```

## Usage

```php
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

- [Lars Rasmussen](https://github.com/larasmorningtrain)
- [Martin Schadegg Brønniche](https://github.com/mschadegg)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
