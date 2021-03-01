<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapConfigurationBuilder
{
    public static function build(
        string $name,
        string $databaseTyp,
        string $path,
        ?string $databaseName = null,
        ?int $databasePort = null,
        ?string $databaseHost = null,
        ?string $databaseUsername = null,
        ?string $databasePassword = null
    ): SitemapConfiguration {
        if ($databasePort === null & $databaseHost === null & $databaseUsername === null &
            $databasePassword === null & $databaseName === null) {
            $array = [
                'name' => Name::fromString($name),
                'database' => [
                    'typ' => Typ::fromString($databaseTyp)
                ],
                'path' => Path::fromString($path)
            ];
        } else {
            $array = [
                'name' => Name::fromString($name),
                'database' => [
                    'db_name' => Name::fromString($databaseName),
                    'typ' => Typ::fromString($databaseTyp),
                    'port' => Port::fromInt($databasePort),
                    'host' => Host::fromString($databaseHost),
                    'username' => Username::fromString($databaseUsername),
                    'password' => Password::fromString($databasePassword)
                ],
                'path' => Path::fromString($path)
            ];
        }

        return SitemapConfiguration::fromArray($array);
    }
}
