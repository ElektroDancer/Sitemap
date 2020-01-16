<?php

namespace sitemap;

require_once(__DIR__ . '/../vendor/autoload.php');

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

echo date('Y-m-d', $timestamp);