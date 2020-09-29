<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapRemover
{
    private SQLitePageLoader $loader;
    private SQLitePageRemoverById $remover;

    public function __construct(
        SQLitePageLoader $loader,
        SQLitePageRemoverById $remover
    ) {
        $this->loader = $loader;
        $this->remover = $remover;
    }

    public function remove(): bool
    {
        return false;
    }
}
