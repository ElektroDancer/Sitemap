<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Sitemap
{
    private Path $path;
    private string $name;

    private SitemapCreator $creator;
    private SitemapUpdater $updater;
    private SQLitePageWriter $writer;
    private SitemapRemover $remover;
    private SitemapEntryBuilder $builder;

    /**
     * @throws InvalidPathException
     */
    public function __construct(
        string $path,
        string $name
    ) {
        $this->path = Path::fromString($path);
        $this->name = $name;

        $factory = new Factory();
        $this->creator = $factory->createSitemapCreator();
        $this->updater = $factory->createSitemapUpdater($name);
        $this->writer = $factory->createSQLitePageWriter($name);
        $this->remover = $factory->createSitemapRemover($name);
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
