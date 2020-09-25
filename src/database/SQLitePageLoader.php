<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;
use PDO;

class SQLitePageLoader
{
    private LazyPDO $pdo;

    public function __construct(SQLiteConnector $connector)
    {
        $this->pdo = $connector->getConnection();
    }

    public function load(): SitemapEntries
    {
        $statement = $this->pdo->prepare($this->getPreparedStatement());
        $statement->execute();
        return $this->getEntry($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    private function getPreparedStatement(): string
    {
        return 'SELECT id, url, last_modify FROM page';
    }

    private function getEntry($result): SitemapEntries
    {
        $array = [];

        foreach ($result as $entry) {
            $array[] = SitemapEntry::fromParameters(
                Url::fromString($entry['url']),
                LastModify::fromString($entry['last_modify'])
            );
        }

        return SitemapEntries::fromArray($array);
    }
}
