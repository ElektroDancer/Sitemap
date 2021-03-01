<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;
use PDO;

class PageLoader
{
    private SitemapCollectionBuilder $builder;
    private LazyPDO $pdo;

    public function __construct(Connector $connector, SitemapCollectionBuilder $builder)
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
        return 'SELECT id, url, last_modify FROM page';
    }
}
