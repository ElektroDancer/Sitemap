<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use LazyPDO\LazyPDO;

interface Connector
{
    public function getConnection(): LazyPDO;
}
