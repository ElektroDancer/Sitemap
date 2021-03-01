<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class PageUpdaterById
{
    private LazyPDO $pdo;

    public function __construct(Connector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function update(SitemapEntry $entry): bool
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->bindValue(':id', $entry->getId()->asInt());
        $statement->bindValue(':url', $entry->getUrl()->asString());
        $statement->bindValue(':last_modify', $entry->getLastModify()->asString());

        return $statement->execute();
    }

    private function getPreparedStatement(): string
    {
        return 'UPDATE page SET url = :url, last_modify = :last_modify WHERE id = :id';
    }
}
