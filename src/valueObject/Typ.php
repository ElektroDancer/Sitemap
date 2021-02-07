<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Typ
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidTypeException
     */
    public static function fromString($value): self
    {
        self::ensureIsString($value);
        self::ensureTypIsDefined($value);

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function ensureIsString($value): void
    {
        if (!is_string($value)) {
            throw new InvalidTypeException('The value of Typ is not a string');
        }
    }

    private static function ensureTypIsDefined(string $value): void
    {
        $expected = ['mysql', 'sqlite'];
        $defined = false;

        foreach ($expected as $expectedTyp) {
            if ($expectedTyp === $value) {
                $defined = true;
            }
        }

        if (!$defined) {
            throw new InvalidTypeException('The value of Typ is not defined');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }
}
