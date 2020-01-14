<?php

namespace sitemap;

class FileHandler
{
    /**
     * @var Path
     */
    private Path $path;
    /**
     * @var PHPVariablesWrapper
     */
    private PHPVariablesWrapper $variablesWrapper;

    /**
     * FileHandler constructor.
     * @param Path $path
     * @param PHPVariablesWrapper $variablesWrapper
     */
    private function __construct(
        Path $path,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->path = $path;
        $this->variablesWrapper = $variablesWrapper;
    }

    /**
     * @param Path $path
     * @param PHPVariablesWrapper $variablesWrapper
     * @return FileHandler
     */
    public static function fromParameters(
        Path $path,
        PHPVariablesWrapper $variablesWrapper
    ): FileHandler {
        return new FileHandler(
            $path,
            $variablesWrapper
        );
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function load(): string
    {
        return $this->variablesWrapper->getFile($this->path);
    }

    /**
     * @param string $data
     * @throws \InvalidArgumentException
     */
    public function save(string $data): void
    {
        $this->variablesWrapper->putFile($this->path, $data);
    }
}