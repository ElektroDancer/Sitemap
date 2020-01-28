<?php

namespace sitemap;

require_once(__DIR__ . '/../vendor/autoload.php');

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

$date = date('Y-m-d', $timestamp);

$xml = new SitemapCreater(new \DOMDocument('1.0', 'utf-8'), new PHPVariablesWrapper());
var_dump($xml->create(Path::fromString('test.xml'), Url::fromString('http://text2.de'), LastModify::fromString($date)));