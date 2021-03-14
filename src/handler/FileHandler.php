<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class FileHandler
{
    private Path $path;
    private PHPVariablesWrapper $variablesWrapper;

    private function __construct(
        Path $path,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->path = $path;
        $this->variablesWrapper = $variablesWrapper;
    }

    public static function fromParameters(
        Path $path,
        PHPVariablesWrapper $variablesWrapper
    ): FileHandler {
        return new FileHandler(
            $path,
            $variablesWrapper
        );
    }

    public function load(): string
    {
        try {
            $data = $this->variablesWrapper->getFile($this->path);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('File could not be found');
        }

        return $data;
    }

    public function save(string $data): bool
    {
        try {
            $this->variablesWrapper->putFile($this->path, $data);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('File could not be written');
        }

        return true;
    }
}