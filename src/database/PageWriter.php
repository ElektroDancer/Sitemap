<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class PageWriter
{
    private LazyPDO $pdo;

    public function __construct(Connector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function save(SitemapEntry $entry): bool
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->bindValue(':url', $entry->getUrl()->asString());
        $statement->bindValue(':last_modify', $entry->getLastModify()->asString());

        return $statement->execute();
    }

    private function getPreparedStatement(): string
    {
        return 'INSERT INTO page (url, last_modify) values (:url, :last_modify)';
    }
}
