<?php

namespace sitemap;

require_once(__DIR__ . '/../vendor/autoload.php');

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

$date = date('Y-m-d', $timestamp);

$xml = new SitemapCreater(new \DOMDocument('1.0', 'utf-8'), new PHPVariablesWrapper());
$sitemapEntries = SitemapEntries::fromArray(
    [
        SitemapEntry::fromParameters(
            Url::fromString('http://test.de/1'),
            LastModify::fromString($date)
        ),
        SitemapEntry::fromParameters(
            Url::fromString('http://test.de/2'),
            LastModify::fromString($date)
        ),
        SitemapEntry::fromParameters(
            Url::fromString('http://test.de/3'),
            LastModify::fromString($date)
        )
    ]
);
$path = Path::fromString('test.xml');
var_dump($xml->create($sitemapEntries, $path));