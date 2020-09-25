<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class Url
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Url constructor.
     * @param mixed $value
     */
    private function __construct($value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return Url
     */
    public static function fromString($value): Url
    {
        return new Url($value);
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
    }
}