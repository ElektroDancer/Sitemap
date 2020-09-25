<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class Path
{
    private string $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromString($value): Path
    {
        self::ensureIsString($value);
        self::ensureStringIsTooLong($value);

        return new Path($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('The value of Path is not a string.');
        }
    }

    private static function ensureStringIsTooLong($value): void
    {
        if (mb_strlen($value) > 255) {
            throw new InvalidArgumentException('This path is too long.');
        }
    }
}