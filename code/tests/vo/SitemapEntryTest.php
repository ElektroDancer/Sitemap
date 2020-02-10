<?php

namespace sitemap;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class SitemapEntryTest
 * @covers \sitemap\SitemapEntry
 * @uses   \sitemap\Url
 * @uses   \sitemap\LastModify
 */
class SitemapEntryTest extends TestCase
{
    /**
     * @var SitemapEntry
     */
    private SitemapEntry $sitemapEntry;
    /**
     * @var MockObject|Url
     */
    private MockObject $urlMock;
    /**
     * @var MockObject|LastModify
     */
    private MockObject $lastModifyMock;

    protected function setUp(): void
    {
        $this->urlMock = $this->createMock(Url::class);
        $this->lastModifyMock = $this->createMock(LastModify::class);

        $this->sitemapEntry = SitemapEntry::fromParameters(
            $this->urlMock,
            $this->lastModifyMock
        );
    }

    public function testCreateFromParameters(): void
    {
        $this->assertInstanceOf(
            SitemapEntry::class,
            SitemapEntry::fromParameters(
                $this->urlMock,
                $this->lastModifyMock
            )
        );
    }

    public function testGetUrl(): void
    {
        $this->assertInstanceOf(
            Url::class,
            $this->sitemapEntry->getUrl()
        );
    }

    public function testGetLastModify(): void
    {
        $this->assertInstanceOf(
            LastModify::class,
            $this->sitemapEntry->getLastModify()
        );
    }
}