<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

interface Configuration
{
    public static function fromArray(array $configuration): self;

    public function getName(): Name;
    public function getDatabaseTyp(): Typ;
    public function getPath(): Path;
}
