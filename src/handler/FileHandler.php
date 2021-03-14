<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

class FileHandler
{
    private PHPVariablesWrapper $variablesWrapper;
    private Path $path;
    private Name $name;

    private function __construct(
        Path $path,
        Name $name,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->path = $path;
        $this->name = $name;
        $this->variablesWrapper = $variablesWrapper;
    }

    public static function fromParameters(
        Path $path,
        Name $name,
        PHPVariablesWrapper $variablesWrapper
    ): FileHandler {
        return new FileHandler(
            $path,
            $name,
            $variablesWrapper
        );
    }

    public function load(): string
    {
        try {
            $data = $this->variablesWrapper->getFile($this->path, $this->name);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('File could not be found');
        }

        return $data;
    }

    public function save(string $data): bool
    {
        try {
            $this->variablesWrapper->putFile($this->path, $this->name, $data);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('File could not be written');
        }

        return true;
    }
}