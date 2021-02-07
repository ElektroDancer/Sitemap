<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapCollection
{
    private array $value;
    
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidSitemapCollectionException
     */
    public static function fromArray($value): SitemapCollection
    {
        self::ensureValueIsArray($value);
        self::ensureValueContentIsSitemapEntry($value);
        
        return new SitemapCollection($value);
    }
    
    public function getValue(): array
    {
        return $this->value;
    }
    
    private static function ensureValueIsArray($value): void
    {
        if (!is_array($value)) {
            throw new InvalidSitemapCollectionException('The argument is not a array.');
        }
    }

    private static function ensureValueContentIsSitemapEntry($value): void
    {
        foreach ($value as $entry) {
            if (!$entry instanceof SitemapEntry) {
                throw new InvalidSitemapCollectionException('The content of the array is not of type SitemapEntry');
            }
        }
    }
}