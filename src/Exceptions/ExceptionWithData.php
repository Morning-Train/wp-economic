<?php

namespace Morningtrain\WpEconomic\Exceptions;

use Exception;
use Throwable;

class ExceptionWithData extends Exception
{
    protected array $extraData;

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null, array $extraData = [])
    {
        parent::__construct($message, $code, $previous);

        $this->extraData = $extraData;
    }

    public function getDetailedMessage(): string
    {
        $parts = [];

        foreach ($this->extraData as $key => $value) {
            if (is_array($value)) {
                $parts[] = '<strong>'.ucfirst($key).'</strong>:'.PHP_EOL.$this->arrayToString($value);

                continue;

            }

            $parts[] = '<strong>'.ucfirst($key).'</strong>:'.PHP_EOL.$value;
        }

        return implode(PHP_EOL, $parts);
    }

    private function arrayToString(array $array, int $indent = 0): string
    {
        $parts = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $parts[] = $this->arrayToString($value, $indent + 2);

                continue;
            }

            if (is_numeric($key)) {
                $parts[] = str_repeat(' ', $indent).'- '.$value;

                continue;
            }

            $parts[] = str_repeat(' ', $indent).ucfirst($key).'- '.": $value";
        }

        return implode(PHP_EOL, $parts);
    }
}
