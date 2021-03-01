<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;
use PDO;

class MySQLConnector implements Connector
{
    private LazyPDO $connection;

    public function __construct(
        Name $name,
        Port $port,
        Host $host,
        Username $username,
        Password $password
    ) {
        $database = 'mysql:host=' . $host->asString() . ';port= . ' . $port->asInt() .
            ';dbname=' . $name->asString();

        $connection = new LazyPDO($database, $username->asString(), $password->asString());
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $connection;
    }

    public function getConnection(): LazyPDO
    {
        return $this->connection;
    }
}
