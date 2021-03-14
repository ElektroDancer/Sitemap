<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;
use InvalidArgumentException;

class SitemapCreator
{
    private DOMDocument $dom;
    private PHPVariablesWrapper $variablesWrapper;
    private PageLoader $loader;
    private Path $path;
    private Name $name;

    public function __construct(
        DOMDocument $dom,
        PHPVariablesWrapper $variablesWrapper,
        PageLoader $loader,
        Path $path,
        Name $name
    ) {
        $this->dom = $dom;
        $this->variablesWrapper = $variablesWrapper;
        $this->loader = $loader;
        $this->path = $path;
        $this->name = $name;
    }

    public function create(): bool
    {
        $collection = $this->loader->load();

        $xmlRoot = $this->dom->createElement('urlset');
        $xmlRoot->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->dom->appendChild($xmlRoot);

        foreach ($collection->asArray() as $entry) {
            $xmlRoot->appendChild($xmlEntry = $this->dom->createElement('url'));
            $xmlEntry->appendChild($this->dom->createElement('loc', (string)$entry->getUrl()));
            $xmlEntry->appendChild($this->dom->createElement('lastmod', (string)$entry->getLastModify()));
        }

        try {
            $file = FileHandler::fromParameters($this->path, $this->name, $this->variablesWrapper);
        } catch (InvalidArgumentException) {
            return false;
        }

        try {
            return $file->save($this->dom->saveXML());
        } catch (InvalidArgumentException) {
            return false;
        }
    }
}