<?php

namespace sitemap;

/**
 * Class PHPVariablesWrapper
 * @package sitemap
 * @codeCoverageIgnore
 */
class PHPVariablesWrapper
{
    /**
     * @param Path $path
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getFile(Path $path): string
    {
        $fileContent = file_get_contents(__DIR__ . "/" . $path);

        if (!is_string($fileContent)) {
            throw new \InvalidArgumentException('File could not be found');
        }

        return $fileContent;
    }

    /**
     * @param Path $path
     * @param string $data
     * @throws \InvalidArgumentException
     */
    public function putFile(Path $path, string $data): void
    {
        $fileSize = file_put_contents($path, $data);

        if (!is_int($fileSize)) {
            throw new \InvalidArgumentException('File could not be written');
        }
    }
}