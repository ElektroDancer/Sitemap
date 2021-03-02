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

    public function remove(SitemapEntry $entry): bool
    {
        $collection = $this->loader->load();

        foreach ($collection->asArray() as $databaseEntry) {
            if ($entry->getUrl()->asString() === $databaseEntry->getUrl()->asString()) {
                $entry->setId($databaseEntry->getId());
            }
        }

        if ($entry->getId()->isNull()) {
            throw new SitemapRemoverException('given url could not find in database');
        }

        return false;
    }
}
