<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class Sitemap
{
    private Path $path;
    private SitemapCreator $creator;
    private SitemapUpdater $updater;

    /**
     * @throws InvalidPathException
     */
    public function __construct(string $path)
    {
        $factory = new Factory();

        $this->path = Path::fromString($path);
        $this->creator = $factory->createSitemapCreator();
        $this->updater = $factory->createSitemapUpdater();
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
        return false;
    }

    /**
     * @throws InvalidURLException
     */
    public function update(string $url): bool
    {
        return $this->updater->update();
    }
}
