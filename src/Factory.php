<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;

class Factory
{
    public function createSitemapCreator(): SitemapCreator
    {
        return new SitemapCreator(
            $this->createDOMDocument(),
            $this->createPHPVariablesWrapper()
        );
    }

    public function createSitemapUpdater(): SitemapUpdater
    {
        return new SitemapUpdater(
            $this->createDOMDocument(),
            $this->createPHPVariablesWrapper()
        );
    }

    private function createDOMDocument(): DOMDocument
    {
        return new DOMDocument('1.0', 'utf-8');
    }

    private function createPHPVariablesWrapper(): PHPVariablesWrapper
    {
        return new PHPVariablesWrapper();
    }
}
