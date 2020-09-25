<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class Path
{
    private string $value;

    private function __construct($value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    public static function fromString($value): Path
    {
        return new Path($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsValid($value): void
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('This is not a string: "' . $value . '"');
        }

        if (mb_strlen($value) > 255) {
            throw new InvalidArgumentException('This path is too long: "' . $value . '"');
        }
    }
}