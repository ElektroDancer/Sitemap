<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Sitemap
{
    private Path $path;
    private string $name;

    private SitemapCreator $creator;
    private SitemapUpdater $updater;
    private SitemapWriter $writer;
    private SitemapEntryBuilder $builder;

    /**
     * @throws InvalidPathException
     */
    public function __construct(string $path, string $name)
    {
        $this->path = Path::fromString($path);
        $this->name = $name;

        $factory = new Factory();
        $this->creator = $factory->createSitemapCreator();
        $this->updater = $factory->createSitemapUpdater($name);
        $this->writer = $factory->createSitemapWriter($name);
        $this->builder = $factory->createSitemapEntryBuilder();
    }

    public function create(): bool
    {
        return false;
    }

    /**
     * @throws InvalidURLException
     */
    public function add(string $url): bool
    {
        try {
            $entry = $this->builder->build($url);
        } catch (InvalidLastModifyException $e) {
            return false;
        }

        return $this->writer->write($entry);
    }

    /**
     * @throws InvalidURLException
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
        return false;
    }
}
