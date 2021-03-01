<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Username
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidUsernameException
     */
    public static function fromString($value): self
    {
        self::ensureUsernameIsString($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureUsernameIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidUsernameException('The value of Username is not a string');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}
