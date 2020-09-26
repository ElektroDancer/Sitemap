<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;

class SitemapUpdater
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

    public function update(): bool
    {
        return false;
    }
}
