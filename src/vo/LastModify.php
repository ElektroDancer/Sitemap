<?php

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class LastModify
{
    /**
     * @var string
     */
    private string $value;

    /**
     * LastModify constructor.
     * @param mixed $value
     */
    private function __construct($value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return LastModify
     */
    public static function fromString($value): LastModify
    {
        return new LastModify($value);
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

        $dateArray = explode('-', $value);
        if (sizeof($dateArray) == 3) {
            if (!checkdate($dateArray[1], $dateArray[2], $dateArray[0])) {
                throw new InvalidArgumentException('This date is not in the correct form: "' . $value . '"');
            }
        } else {
            throw new InvalidArgumentException('This is not a date: "' . $value . '"');
        }
    }
}