<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Url
{
    private string $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidUrlException
     */
    public static function fromString($value): Url
    {
        self::ensureIsString($value);
        self::ensureIsValidateUrl($value);

        return new Url($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidUrlException('The value of Url is not a string');
        }
    }

    private static function ensureIsValidateUrl(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException('The value of Url is not a validate Url');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}