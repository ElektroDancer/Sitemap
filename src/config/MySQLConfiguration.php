<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class MySQLConfiguration implements Configuration
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

        if (!isset($configuration['database']['name'])) {
            throw new KeyNotSetException('The name key for database is net set');
        }

        if (!isset($configuration['database']['port'])) {
            throw new KeyNotSetException('The port key for database is net set');
        }

        if (!isset($configuration['database']['host'])) {
            throw new KeyNotSetException('The host key for database is net set');
        }

        if (!isset($configuration['database']['username'])) {
            throw new KeyNotSetException('The username key for database is net set');
        }

        if (!isset($configuration['database']['password'])) {
            throw new KeyNotSetException('The password key for database is net set');
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

    public function getDatabaseTyp(): Typ
    {
        return $this->configuration['database']['typ'];
    }

    public function getDatabaseName(): Name
    {
        return $this->configuration['database']['name'];
    }

    public function getDatabasePort(): Port
    {
        return $this->configuration['database']['port'];
    }

    public function getDatabaseHost(): Host
    {
        return $this->configuration['database']['host'];
    }

    public function getDatabaseUsername(): Username
    {
        return $this->configuration['database']['username'];
    }

    public function getDatabasePassword(): Password
    {
        return $this->configuration['database']['password'];
    }

    public function getPath(): Path
    {
        return $this->configuration['path'];
    }
}
