<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Sitemap
{
    private SitemapCreator $creator;
    private SitemapUpdater $updater;
    private PageWriter $writer;
    private SitemapRemover $remover;
    private SitemapEntryBuilder $builder;

    public function __construct(
        Configuration $configuration
    ) {
        $factory = new Factory();
        $this->creator = $factory->createSitemapCreator($configuration);
        $this->updater = $factory->createSitemapUpdater($configuration);
        $this->writer = $factory->createPageWriter($configuration);
        $this->remover = $factory->createSitemapRemover($configuration);
        $this->builder = $factory->createSitemapEntryBuilder();
    }

    public function create(): bool
    {
        return $this->creator->create();
    }

    /**
     * @throws InvalidUrlException
     */
    public function add(string $url): bool
    {
        try {
            $entry = $this->builder->build($url);
        } catch (InvalidLastModifyException) {
            return false;
        }

        return $this->writer->save($entry);
    }

    /**
     * @throws InvalidUrlException
     */
    public function update(string $url): bool
    {
        try {
            $entry = $this->builder->build($url);
            return $this->updater->update($entry);
        } catch (InvalidLastModifyException | SitemapUpdateException) {
            return false;
        }
    }

    /**
     * @throws InvalidUrlException
     */
    public function remove(string $url): bool
    {
        try {
            $entry = $this->builder->build($url);
            return $this->remover->remove($entry);
        } catch (InvalidLastModifyException | SitemapRemoverException) {
            return false;
        }
    }
}
