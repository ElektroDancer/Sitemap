<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapCollectionBuilder
{
    /**
     * @throws InvalidUrlException
     * @throws InvalidLastModifyException
     */
    public function build(array $entries): SitemapCollection
    {
        $array = [];

        foreach ($entries as $entry) {
            $array[] = SitemapEntry::fromParameters(
                Id::fromInt((int)$entry['id']),
                Url::fromString($entry['url']),
                LastModify::fromString($entry['last_modify'])
            );
        }

        return SitemapCollection::fromArray($array);
    }
}
