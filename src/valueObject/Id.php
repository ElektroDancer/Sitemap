<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Id
{
    private ?int $value;

    private function __construct(?int $value)
    {
        $this->value = $value;
    }

    public static function fromInt($value): self
    {
        self::ensureIdIsInt($value);

        return new self($value);
    }

    public static function null(): self
    {
        return new self(null);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    private static function ensureIdIsInt($value): void
    {
        if (!is_int($value)) {
            throw new InvalidIdException('The value of Id is not a integer');
        }
    }

    public function asInt(): int
    {
        if ($this->isNull()) {
            throw new InvalidIdException('The value of Id is null');
        }

        return $this->value;
    }

    public function isNull(): bool
    {
        return !is_int($this->value);
    }
}
