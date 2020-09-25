<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntry
{
    private Url $url;
    private LastModify $lastModify;

    private function __construct(
        Url $url,
        LastModify $lastModify
    ) {
        $this->url = $url;
        $this->lastModify = $lastModify;
    }

    public static function fromParameters(
        Url $url,
        LastModify $lastModify
    ): SitemapEntry {
        return new SitemapEntry(
            $url,
            $lastModify
        );
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function getLastModify(): LastModify
    {
        return $this->lastModify;
    }
}