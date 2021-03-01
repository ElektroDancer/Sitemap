<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntryBuilder
{
    /**
     * @throws InvalidUrlException
     * @throws InvalidLastModifyException
     */
    public function build(string $url): SitemapEntry
    {
        return SitemapEntry::fromParameters(
            Id::null(),
            Url::fromString($url),
            LastModify::fromString(date('Y-m-d'))
        );
    }
}
