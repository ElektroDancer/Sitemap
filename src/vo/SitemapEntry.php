<?php

namespace elektrodancer\sitemap;

class SitemapEntry
{
    /**
     * @var Url
     */
    private Url $url;
    /**
     * @var LastModify
     */
    private LastModify $lastModify;

    /**
     * SitemapEntry constructor.
     * @param Url $url
     * @param LastModify $lastModify
     */
    private function __construct(
        Url $url,
        LastModify $lastModify
    ) {
        $this->url = $url;
        $this->lastModify = $lastModify;
    }

    /**
     * @param Url $url
     * @param LastModify $lastModify
     * @return SitemapEntry
     */
    public static function fromParameters(
        Url $url,
        LastModify $lastModify
    ): SitemapEntry {
        return new SitemapEntry(
            $url,
            $lastModify
        );
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @return LastModify
     */
    public function getLastModify(): LastModify
    {
        return $this->lastModify;
    }
}