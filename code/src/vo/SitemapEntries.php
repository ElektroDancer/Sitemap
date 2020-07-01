<?php

namespace sitemap;

use InvalidArgumentException;

class SitemapEntries
{
    /**
     * @var array
     */
    private array $value;

    /**
     * SitemapEntries constructor.
     * @param mixed $value
     */
    private function __construct($value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    /**
     * @param $value
     * @return SitemapEntries
     */
    public static function fromArray($value): SitemapEntries
    {
        return new SitemapEntries($value);
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @throws InvalidArgumentException
     */
    private function ensureIsValid($value): void
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('The argument is not a array.');
        }

        for ($i = 0; $i < sizeof($value); $i++) {
            if (!is_a($value[$i], 'sitemap\SitemapEntry')) {
                throw new InvalidArgumentException('The content of the array is not of type SitemapEntry');
            }
        }
    }
}