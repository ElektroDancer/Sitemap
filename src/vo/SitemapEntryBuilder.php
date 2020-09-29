<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntryBuilder
{
    public function __construct()
    {
        date_default_timezone_set("Europe/Berlin");
    }

    /**
     * @throws InvalidURLException
     * @throws InvalidLastModifyException
     */
    public function build(string $url): SitemapEntry
    {
        $date = date('Y-m-d');

        return SitemapEntry::fromParameters(
            Url::fromString($url),
            LastModify::fromString($date)
        );
    }
}
