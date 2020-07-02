<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use PDO;

class SQLiteConnector
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * SQLiteConnector constructor.
     * @param string $databaseName
     */
    public function __construct(string $databaseName)
    {
        $path = $databaseName . '.sqlite';

        if (!file_exists($path)) {
            echo 'if';
            $connection = new PDO('sqlite:' . $path);
            $this->createDatabase($connection);
        } else {
            echo 'else';
            $connection = new PDO('sqlite:', $path);
        }

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $connection;
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * @param PDO $connection
     */
    private function createDatabase(PDO $connection): void
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
