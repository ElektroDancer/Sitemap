<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;
use InvalidArgumentException;

class SitemapCreator
{
    private DOMDocument $dom;
    private PHPVariablesWrapper $variablesWrapper;

    public function __construct(
        DOMDocument $dom,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->dom = $dom;
        $this->variablesWrapper = $variablesWrapper;
    }

    public function create(SitemapCollection $collection, Path $path): bool
    {
        $root = $this->dom->createElement('urlset');
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->dom->appendChild($root);

        foreach ($collection->asArray() as $value) {
            $root->appendChild($entry = $this->dom->createElement('url'));
            $entry->appendChild($this->dom->createElement('loc', (string)$value->getUrl()));
            $entry->appendChild($this->dom->createElement('lastmod', (string)$value->getLastModify()));
        }

        try {
            $file = FileHandler::fromParameters($path, $this->variablesWrapper);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        try {
            $file->save($this->dom->saveXML());
        } catch (InvalidArgumentException $e) {
            return false;
        }
        return true;
    }
}