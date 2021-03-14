<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntryEditorBuilder
{
    private PageLoader $loader;
    private SitemapEntryBuilder $builder;

    public function __construct(PageLoader $loader,SitemapEntryBuilder $builder)
    {
        $this->loader = $loader;
        $this->builder = $builder;
    }

    public function edit(Url $oldUrl, string $newUrl): SitemapEntry
    {
        $entry = $this->builder->build($newUrl);
        $collection = $this->loader->load();

        foreach ($collection->asArray() as $databaseEntry) {
            if ($oldUrl->asString() === $databaseEntry->getUrl()->asString()) {
                $entry->setId($databaseEntry->getId());
                break;
            }
        }


        if ($entry->getId()->isNull()) {
            throw new SitemapRemoverException('given url could not find in database');
        }

        return $entry;
    }
}
