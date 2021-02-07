<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

class SitemapConfigurationBuilder
{
    public function build(
        string $name,
        string $databaseTyp,
        string $path,
        ?int $databasePort = null,
        ?string $databaseHost = null
    ): SitemapConfiguration {
        if ($databasePort === null & $databaseHost === null) {
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
                    'typ' => Typ::fromString($databaseTyp),
                    'port' => Port::fromInt($databasePort),
                    'host' => Host::fromString($databaseHost)
                ],
                'path' => Path::fromString($path)
            ];
        }

        return SitemapConfiguration::fromArray($array);
    }
}
