<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class SQLitePageWriter
{
    private LazyPDO $pdo;

    public function __construct(SQLiteConnector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function save(SitemapEntry $entry): bool
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->bindValue(':url', $entry->getUrl());
        $statement->bindValue(':last_modify', $entry->getLastModify());

        return $statement->execute();
    }

    private function getPreparedStatement(): string
    {
        return 'INSERT INTO page (url, last_modify) values (:url, :last_modify)';
    }
}
