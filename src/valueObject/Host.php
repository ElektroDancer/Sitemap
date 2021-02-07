<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Host
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidHostException
     */
    public static function fromString($value): self
    {
        self::ensureHostIsString($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureHostIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidHostException('The value of Host is not a string');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}
