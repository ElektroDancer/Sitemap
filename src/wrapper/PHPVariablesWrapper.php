<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

/**
 * @codeCoverageIgnore
 */
class PHPVariablesWrapper
{
    public function getFile(Path $path, Name $name): string
    {
        $fileContent = file_get_contents(
            __DIR__ . "/../../public/" . $path->asString() . '/' . $name->asString() . '.xml'
        );

        if (!is_string($fileContent)) {
            throw new InvalidArgumentException('File could not be found');
        }

        return $fileContent;
    }

    public function putFile(Path $path, Name $name, string $data): void
    {
        $fileSize = file_put_contents(
            __DIR__ . "/../../public/" . $path->asString() . '/' . $name->asString() . '.xml',
            $data
        );

        if (!is_int($fileSize)) {
            throw new InvalidArgumentException('File could not be written');
        }
    }
}