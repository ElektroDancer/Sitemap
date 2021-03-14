<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapConfigurationBuilder
{
    public static function build(
        string $name,
        string $databaseTyp,
        string $path,
        string $databaseName = null,
        int $databasePort = null,
        string $databaseHost = null,
        string $databaseUsername = null,
        string $databasePassword = null
    ): Configuration {
        if ($databaseTyp === 'sqlite') {
            return SQLiteConfiguration::fromArray(
                [
                    'name' => Name::fromString($name),
                    'database' => [
                        'typ' => Typ::fromString($databaseTyp)
                    ],
                    'path' => Path::fromString($path)
                ]
            );
        }

        if ($databaseTyp === 'mysql') {
            return MySQLConfiguration::fromArray(
                [
                    'name' => Name::fromString($name),
                    'database' => [
                        'name' => Name::fromString($databaseName),
                        'typ' => Typ::fromString($databaseTyp),
                        'port' => Port::fromInt($databasePort),
                        'host' => Host::fromString($databaseHost),
                        'username' => Username::fromString($databaseUsername),
                        'password' => Password::fromString($databasePassword)
                    ],
                    'path' => Path::fromString($path)
                ]
            );
        }

        throw new InvalidTypeException('database typ can not be processed');
    }
}
