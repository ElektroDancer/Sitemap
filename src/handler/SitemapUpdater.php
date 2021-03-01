<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapUpdater
{
    private PageLoader $loader;
    private PageUpdaterById $updater;

    public function __construct(
        PageLoader $loader,
        PageUpdaterById $updater
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
