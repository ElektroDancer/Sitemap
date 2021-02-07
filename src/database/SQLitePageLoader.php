<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;
use PDO;

class SQLitePageLoader
{
    private SitemapCollectionBuilder $builder;
    private LazyPDO $pdo;

    public function __construct(SQLiteConnector $connector, SitemapCollectionBuilder $builder)
    {
        $this->pdo = $connector->getConnection();
        $this->builder = $builder;
    }

    public function load(): SitemapCollection
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->execute();
        return $this->builder->build($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    private function getPreparedStatement(): string
    {
        return 'SELECT url, last_modify FROM page';
    }
}
