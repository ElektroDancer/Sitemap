<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Name
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidNameException
     */
    public static function fromString($value): self
    {
        self::ensureNameIsString($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureNameIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidNameException('The value of name is not a string');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}
