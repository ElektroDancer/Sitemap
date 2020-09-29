<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;
use sitemap\InvalidURLException;

class Url
{
    private string $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromString($value): Url
    {
        self::ensureIsString($value);

        return new Url($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidURLException('The value of Url is not a string.');
        }
    }
}