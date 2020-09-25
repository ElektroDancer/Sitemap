<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class SitemapEntries
{
    private array $value;
    
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromArray($value): SitemapEntries
    {
        self::ensureValueIsArray($value);
        self::ensureValueContentIsSitemapEntry($value);
        
        return new SitemapEntries($value);
    }
    
    public function getValue(): array
    {
        return $this->value;
    }
    
    private static function ensureValueIsArray($value): void
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('The argument is not a array.');
        }
    }

    private static function ensureValueContentIsSitemapEntry($value): void
    {
        foreach ($value as $entry) {
            if (!$entry instanceof SitemapEntry) {
                throw new InvalidArgumentException('The content of the array is not of type SitemapEntry');
            }
        }
    }
}