<?php

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class Path
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Path constructor.
     * @param $value
     */
    private function __construct($value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    /**
     * @param $value
     * @return Path
     */
    public static function fromString($value): Path
    {
        return new Path($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @param mixed $value
     * @throws InvalidArgumentException
     */
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