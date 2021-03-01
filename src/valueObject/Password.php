<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Password
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidPasswordException
     */
    public static function fromString($value): self
    {
        self::ensurePasswordIsString($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensurePasswordIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidPasswordException('The value of Password is not a string');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}
