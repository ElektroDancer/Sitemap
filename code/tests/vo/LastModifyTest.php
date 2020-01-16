<?php

use PHPUnit\Framework\TestCase;
use sitemap\LastModify;

/**
 * @covers \sitemap\LastModify
 */
class LastModifyTest extends TestCase
{
    public function testCreateFromString()
    {
        $this->assertInstanceOf(
            LastModify::class,
            LastModify::fromString('2020-01-01')
        );
    }

    /**
     * @param $date
     * @dataProvider provider
     */
    public function testException($date)
    {
        $this->expectException(InvalidArgumentException::class);
        LastModify::fromString($date);
    }

    public function testToString()
    {
        $this->assertIsString((string)LastModify::fromString('2020-01-01'));
    }

    public function provider()
    {
        return array(
            array(1),
            array(true),
            array(false),
            array(1.6),
            array('test'),
            array('01-01-2020'),
            array('2020-13-01'),
            array('2020-01-32')
        );
    }
}