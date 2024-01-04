<?php

namespace Morningtrain\WpEconomic;

use Morningtrain\Economic\Services\EconomicApiService;
use Morningtrain\Economic\Services\EconomicLoggerService;
use Morningtrain\WpEconomic\Drivers\WordPressEconomicDriver;
use Psr\Log\LoggerInterface;

class Economic
{
    public static function setup(string $appSecretToken, string $agreementGrantToken): void
    {
        EconomicApiService::setDriver(new WordPressEconomicDriver($appSecretToken, $agreementGrantToken));
    }

    public static function useLogger(LoggerInterface $logger): void
    {
        EconomicLoggerService::registerLogger($logger);
    }
}
