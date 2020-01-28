<?php

namespace sitemap;

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
     * @param Path $path
     * @param Url $url
     * @param LastModify $lastModify
     * @return bool
     */
    public function create(Path $path, Url $url, LastModify $lastModify): bool
    {
        $root = $this->dom->createElement('sitemapindex');
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->dom->appendChild($root);

        $root->appendChild($entry = $this->dom->createElement('sitemap'));
        $entry->appendChild($this->dom->createElement('loc', $url));
        $entry->appendChild($this->dom->createElement('lastmod', $lastModify));

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