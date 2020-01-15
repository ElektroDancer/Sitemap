<?php

use PHPUnit\Framework\TestCase;
use sitemap\Path;

/**
 * @covers \sitemap\Path
 */
class PathTest extends TestCase
{
    public function testCreateFromString()
    {
        $this->assertInstanceOf(
            Path::class,
            Path::fromString('../tests/path.txt')
        );
    }

    /**
     * @param $date
     * @dataProvider provider
     */
    public function testException($date)
    {
        $this->expectException(InvalidArgumentException::class);
        Path::fromString($date);
    }

    public function testToString()
    {
        $this->assertIsString((string)Path::fromString('../tests/path.txt'));
    }

    public function provider()
    {
        return array(
            array(1),
            array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
            array(true),
            array(false),
            array(1.6)
        );
    }
}