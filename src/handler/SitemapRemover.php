<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapRemover
{
    private PageLoader $loader;
    private PageRemoverById $remover;

    public function __construct(
        PageLoader $loader,
        PageRemoverById $remover
    ) {
        $this->loader = $loader;
        $this->remover = $remover;
    }

    public function remove(): bool
    {
        return false;
    }
}
