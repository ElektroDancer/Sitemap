<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Sitemap
{
    private SitemapCreator $creator;
    private PageWriter $writer;
    private SitemapUpdater $updater;
    private SitemapRemover $remover;
    private SitemapEntryEditorBuilder $editor;
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
        $this->editor = $factory->createSitemapEntryEditorBuilder($configuration);
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

    /**
     * @throws InvalidUrlException
     */
    public function edit(string $oldUrl, string $newUrl): bool
    {
        try {
            $entry = $this->editor->edit(Url::fromString($oldUrl), $newUrl);
            return $this->updater->update($entry);
        } catch (InvalidLastModifyException) {
            return false;
        }
    }
}
