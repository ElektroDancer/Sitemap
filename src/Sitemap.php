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
        SitemapConfiguration $configuration
    ) {
        $factory = new Factory();
        $this->creator = $factory->createSitemapCreator();
        $this->updater = $factory->createSitemapUpdater($configuration);
        $this->writer = $factory->createPageWriter($configuration);
        $this->remover = $factory->createSitemapRemover($configuration);
        $this->builder = $factory->createSitemapEntryBuilder();
    }

    public function create(): bool
    {
        return false;
    }

    /**
     * @throws InvalidUrlException
     */
    public function add(string $url): bool
    {
        try {
            $entry = $this->builder->build($url);
        } catch (InvalidLastModifyException $e) {
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
        } catch (InvalidLastModifyException $e) {
            return false;
        }

        return $this->updater->update($entry);
    }

    public function remove(string $url): bool
    {
        return $this->remover->remove();
    }
}
