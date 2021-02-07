<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class SQLiteConnector
{
    private LazyPDO $connection;

    public function __construct(string $databaseName)
    {
        $path = $databaseName . '.sqlite';

        if (!file_exists($path)) {
            $connection = new LazyPDO('sqlite:' . $path);
            $this->createDatabase($connection);
        } else {
            $connection = new LazyPDO('sqlite:' . $path);
        }

        $this->connection = $connection;
    }

    public function getConnection(): LazyPDO
    {
        return $this->connection;
    }

    private function createDatabase(LazyPDO $connection): void
    {
        $connection->exec($this->getCreateDatabaseStatement());
    }

    private function getCreateDatabaseStatement(): string
    {
        return 'CREATE TABLE page
                        (
                            url VARCHAR(255)
                                CONSTRAINT page_pk
                                    PRIMARY KEY autoincrement,
                            last_modify VARCHAR(10)
                        )';
    }
}
