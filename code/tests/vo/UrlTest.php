<?php

use PHPUnit\Framework\TestCase;
use sitemap\Url;

/**
 * @covers \sitemap\Url
 */
class UrlTest extends TestCase
{
    public function testCreateFromString()
    {
        $this->assertInstanceOf(
            Url::class,
            Url::fromString('http://test.de')
        );
    }

    /**
     * @param $date
     * @dataProvider provider
     */
    public function testException($date)
    {
        $this->expectException(InvalidArgumentException::class);
        Url::fromString($date);
    }

    public function testToString()
    {
        $this->assertIsString((string)Url::fromString('http://test.de'));
    }

    public function provider()
    {
        return array(
            array(1),
            array(true),
            array(false),
            array(1.6)
        );
    }
}