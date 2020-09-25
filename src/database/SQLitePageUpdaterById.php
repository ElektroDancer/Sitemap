<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class SQLitePageUpdaterById
{
    private LazyPDO $pdo;

    public function __construct(SQLiteConnector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function update(SitemapEntry $entry, int $id): bool
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->bindValue(':id', $id);
        $statement->bindValue(':url', $entry->getUrl());
        $statement->bindValue(':last_modify', $entry->getLastModify());

        return $statement->execute();
    }

    private function getPreparedStatement(): string
    {
        return 'UPDATE page SET url = :url, last_modify = :last_modify WHERE id = :id';
    }
}
