<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class LastModify
{
    private string $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromString($value): LastModify
    {
        self::ensureIsString($value);
        self::ensureIsCorrectDate($value);

        return new LastModify($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('The value of LastModify is not a string.');
        }
    }

    private static function ensureIsCorrectDate($value): void
    {
        $dateArray = explode('-', $value);

        if (count($dateArray) === 3) {
            if (!checkdate((int)$dateArray[1], (int)$dateArray[2], (int)$dateArray[0])) {
                throw new InvalidArgumentException('The value of LastModify is not in the correct date form.');
            }
        } else {
            throw new InvalidArgumentException('The value of LastModify is not a date.');
        }
    }
}