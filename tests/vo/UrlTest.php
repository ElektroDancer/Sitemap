<?php

use PHPUnit\Framework\TestCase;
use sitemap\Url;

/**
 * Class UrlTest
 * @covers \sitemap\Url
 */
class UrlTest extends TestCase
{
    public function testCreateFromString(): void
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
    public function testException($date): void
    {
        $this->expectException(InvalidArgumentException::class);
        Url::fromString($date);
    }

    public function testToString(): void
    {
        $this->assertIsString((string)Url::fromString('http://test.de'));
    }

    public function provider(): array
    {
        return array(
            array(1),
            array(true),
            array(false),
            array(1.6)
        );
    }
}