<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

class SQLitePageRemoverById
{
    private LazyPDO $pdo;

    public function __construct(SQLiteConnector $connector)
    {
        $this->pdo = $connector->getConnection();
    }
}
