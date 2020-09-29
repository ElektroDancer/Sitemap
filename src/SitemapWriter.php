<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapWriter
{
    private SQLitePageWriter $writer;

    public function __construct(SQLitePageWriter $writer)
    {
        $this->writer = $writer;
    }

    public function write(SitemapEntry $entry): bool
    {
        return false;
    }
}
