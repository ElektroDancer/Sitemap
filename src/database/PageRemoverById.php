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
}
