<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class PageRemoverById
{
    private LazyPDO $pdo;

    public function __construct(Connector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function remove(SitemapEntry $entry): bool
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->bindValue(':id', $entry->getId()->asInt());

        return $statement->execute();
    }

    private function getPreparedStatement(): string
    {
        return 'DELETE FROM page WHERE id = :id';
    }
}
