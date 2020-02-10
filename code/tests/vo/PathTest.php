<?php

use PHPUnit\Framework\TestCase;
use sitemap\Path;

/**
 * Class PathTest
 * @covers \sitemap\Path
 */
class PathTest extends TestCase
{
    public function testCreateFromString(): void
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
    public function testException($date): void
    {
        $this->expectException(InvalidArgumentException::class);
        Path::fromString($date);
    }

    public function testToString(): void
    {
        $this->assertIsString((string)Path::fromString('../tests/path.txt'));
    }

    public function provider(): array
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