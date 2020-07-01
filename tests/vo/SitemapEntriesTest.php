<?php

namespace sitemap;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class SitemapEntriesTest
 * @covers \sitemap\SitemapEntries
 * @uses   \sitemap\SitemapEntry
 * @uses   \sitemap\Url
 * @uses   \sitemap\LastModify
 */
class SitemapEntriesTest extends TestCase
{
    /**
     * @var SitemapEntries
     */
    private SitemapEntries $sitemapEntries;
    /**
     * @var MockObject|SitemapEntry
     */
    private MockObject $sitemapEntryMock;

    protected function setUp(): void
    {
        $this->sitemapEntryMock = $this->createMock(SitemapEntry::class);

        $this->sitemapEntries = SitemapEntries::fromArray(
            [
                $this->sitemapEntryMock
            ]
        );
    }

    public function testCreateFromArray(): void
    {
        $this->assertInstanceOf(
            SitemapEntries::class,
            SitemapEntries::fromArray(
                [
                    $this->sitemapEntryMock
                ]
            )
        );
    }

    /**
     * @param $value
     * @dataProvider provider
     */
    public function testException($value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        SitemapEntries::fromArray($value);
    }

    public function testGetValue(): void
    {
        $this->assertIsArray(
            $this->sitemapEntries->getValue()
        );
    }

    public function provider(): array
    {
        return array(
            array(1),
            array(1.5),
            array('test'),
            array(true),
            array(false),
            array(
                array('test')
            )
        );
    }
}