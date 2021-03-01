<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapEntry
{
    private Url $url;
    private LastModify $lastModify;
    private Id $id;

    private function __construct(
        Id $id,
        Url $url,
        LastModify $lastModify
    ) {
        $this->url = $url;
        $this->lastModify = $lastModify;
        $this->id = $id;
    }

    public static function fromParameters(
        Id $id,
        Url $url,
        LastModify $lastModify
    ): SitemapEntry {
        return new SitemapEntry(
            $id,
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

    public function getId(): Id
    {
        return $this->id;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}