<?php

namespace elektrodancer\sitemap;

class SitemapCreater
{
    /**
     * @var \DOMDocument
     */
    private \DOMDocument $dom;
    /**
     * @var PHPVariablesWrapper
     */
    private PHPVariablesWrapper $variablesWrapper;

    /**
     * SitemapCreater constructor.
     * @param \DOMDocument $dom
     * @param PHPVariablesWrapper $variablesWrapper
     */
    public function __construct(
        \DOMDocument $dom,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->dom = $dom;
        $this->variablesWrapper = $variablesWrapper;
    }

    /**
     * @param SitemapEntries $entries
     * @param Path $path
     * @return bool
     */
    public function create(SitemapEntries $entries, Path $path): bool
    {
        $root = $this->dom->createElement('urlset');
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->dom->appendChild($root);

        for ($i = 0; $i < sizeof($entries->getValue()); $i++) {
            $root->appendChild($entry = $this->dom->createElement('url'));
            $entry->appendChild($this->dom->createElement('loc', $entries->getValue()[$i]->getUrl()));
            $entry->appendChild($this->dom->createElement('lastmod', $entries->getValue()[$i]->getLastModify()));
        }

        try {
            $file = FileHandler::fromParameters($path, $this->variablesWrapper);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        try {
            $file->save($this->dom->saveXML());
        } catch (\InvalidArgumentException $e) {
            return false;
        }
        return true;
    }
}