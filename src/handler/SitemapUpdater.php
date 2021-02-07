<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapUpdater
{
    private SQLitePageLoader $loader;
    private SQLitePageUpdaterById $updater;

    public function __construct(
        SQLitePageLoader $loader,
        SQLitePageUpdaterById $updater
    ) {
        $this->loader = $loader;
        $this->updater = $updater;
    }

    public function update(SitemapEntry $entry): bool
    {
        $collection = $this->loader->load();

        return false;
    }
}
