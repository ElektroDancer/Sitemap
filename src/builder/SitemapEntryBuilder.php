<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntryBuilder
{
    /**
     * @throws InvalidURLException
     * @throws InvalidLastModifyException
     */
    public function build(string $url): SitemapEntry
    {
        return SitemapEntry::fromParameters(
            Url::fromString($url),
            LastModify::fromString(date('Y-m-d'))
        );
    }
}
