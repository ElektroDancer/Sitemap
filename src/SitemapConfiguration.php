<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapConfiguration
{
    private array $configuration;

    private function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function fromArray(array $configuration): self
    {
        self::ensureNameIsSet($configuration);
        self::ensureDatabaseIsSet($configuration);
        self::ensurePathIsSet($configuration);

        return new self($configuration);
    }

    private static function ensureNameIsSet(array $configuration): void
    {
        if (!isset($configuration['name'])) {
            throw new KeyNotSetException('The name key is not set');
        }
    }

    private static function ensureDatabaseIsSet(array $configuration): void
    {
        if (!isset($configuration['database'])) {
            throw new KeyNotSetException('The database root is not set');
        }

        if (!isset($configuration['database']['typ'])) {
            throw new KeyNotSetException('The typ key for database is net set');
        }

        if ($configuration['database']['typ']->asString() !== 'sqlite') {
            if (!isset($configuration['database']['port'])) {
                throw new KeyNotSetException('The port key for database is net set');
            }

            if (!isset($configuration['database']['host'])) {
                throw new KeyNotSetException('The host key for database is net set');
            }
        }
    }

    private static function ensurePathIsSet(array $configuration): void
    {
        if (!isset($configuration['path'])) {
            throw new KeyNotSetException('The path key is not set');
        }
    }

    public function getName(): Name
    {
        return $this->configuration['name'];
    }

    public function getTyp(): Typ
    {
        return $this->configuration['database']['typ'];
    }

    public function getPort(): Port
    {
        if (!isset($this->configuration['database']['port'])) {
            throw new KeyNotSetException('port is not set in this configuration');
        }

        return $this->configuration['database']['port'];
    }

    public function getHost(): Host
    {
        if (!isset($this->configuration['database']['host'])) {
            throw new KeyNotSetException('host is not set in this configuration');
        }

        return $this->configuration['database']['host'];
    }

    public function getPath(): Path
    {
        return $this->configuration['path'];
    }
}
