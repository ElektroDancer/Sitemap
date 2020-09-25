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
        $connection->exec(
            'CREATE TABLE page
                        (
                            id INTEGER  
                                CONSTRAINT page_pk
                                    PRIMARY KEY autoincrement,
                            url VARCHAR(255),
                            last_modify VARCHAR(10)
                        )'
        );
    }
}
