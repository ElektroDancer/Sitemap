<?php
declare(strict_types=1);

namespace elektrodancer\sitemap;

use InvalidArgumentException;

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
     * @throws InvalidArgumentException
     */
    public function load(): string
    {
        try {
            $data = $this->variablesWrapper->getFile($this->path);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException('File could not be found');
        }

        return $data;
    }

    /**
     * @param string $data
     * @return bool
     * @throws InvalidArgumentException
     */
    public function save(string $data): bool
    {
        try {
            $this->variablesWrapper->putFile($this->path, $data);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException('File could not be written');
        }

        return true;
    }
}