<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Port
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidPortException
     */
    public static function fromInt($value): self
    {
        self::ensurePortIsInt($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    private static function ensurePortIsInt($value): void
    {
        if (!is_int($value)) {
            throw new InvalidPortException('The value of Port is not a integer');
        }
    }

    public function asInt(): int
    {
        return $this->value;
    }
}
