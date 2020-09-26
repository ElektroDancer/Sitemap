<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class Sitemap
{
    private Path $path;
    private SitemapCreator $creator;
    private SitemapUpdater $updater;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $path)
    {
        $factory = new Factory();

        $this->path = Path::fromString($path);
        $this->creator = $factory->createSitemapCreator();
        $this->updater = $factory->createSitemapUpdater();
    }

    public function create(SitemapCollection $collection): bool
    {
        return $this->creator->create($collection, $this->path);
    }

    public function update(SitemapEntry $entry): bool
    {
        return $this->updater->update();
    }
}
