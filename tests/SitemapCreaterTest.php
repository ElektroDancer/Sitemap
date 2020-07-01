<?php

namespace sitemap;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class SitemapCreaterTest
 * @covers \sitemap\SitemapCreater
 * @uses   \sitemap\FileHandler
 */
class SitemapCreaterTest extends TestCase
{
    /**
     * @var SitemapCreater
     */
    private SitemapCreater $sitemapCreater;
    /**
     * @var \DOMDocument
     */
    private \DOMDocument $dom;
    /**
     * @var MockObject|SitemapEntries
     */
    private MockObject $sitemapEntriesMock;
    /**
     * @var MockObject|Path
     */
    private MockObject $pathMock;
    /**
     * @var MockObject
     */
    private MockObject $sitemapEntryMock;
    /**
     * @var MockObject|PHPVariablesWrapper
     */
    private MockObject $variablesWrapperMock;

    protected function setUp(): void
    {
        $this->dom = new \DOMDocument('1.0', 'utf-8');
        $this->sitemapEntriesMock = $this->createMock(SitemapEntries::class);
        $this->pathMock = $this->createMock(Path::class);
        $this->sitemapEntryMock = $this->createMock(SitemapEntry::class);
        $this->variablesWrapperMock = $this->createMock(PHPVariablesWrapper::class);

        $this->sitemapCreater = new SitemapCreater(
            $this->dom,
            $this->variablesWrapperMock
        );
    }

    public function testCreateSuccess(): void
    {
        $this->sitemapEntriesMock->method('getValue')->willReturn([$this->sitemapEntryMock]);
        $this->assertEquals(
            true,
            $this->sitemapCreater->create(
                $this->sitemapEntriesMock,
                $this->pathMock
            )
        );
    }
}