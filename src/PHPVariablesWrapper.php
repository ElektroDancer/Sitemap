<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

/**
 * @codeCoverageIgnore
 */
class PHPVariablesWrapper
{
    public function getFile(Path $path): string
    {
        $fileContent = file_get_contents("/" . $path);

        if (!is_string($fileContent)) {
            throw new InvalidArgumentException('File could not be found');
        }

        return $fileContent;
    }

    public function putFile(Path $path, string $data): void
    {
        $fileSize = file_put_contents("/" . $path, $data);

        if (!is_int($fileSize)) {
            throw new InvalidArgumentException('File could not be written');
        }
    }
}