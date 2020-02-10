<?php

namespace sitemap;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class FileHandlerTest
 * @covers \sitemap\FileHandler
 */
class FileHandlerTest extends TestCase
{
    /**
     * @var FileHandler
     */
    private FileHandler $fileHandler;
    /**
     * @var MockObject|Path
     */
    private MockObject $pathMock;
    /**
     * @var MockObject|PHPVariablesWrapper
     */
    private MockObject $variablesWrapperMock;

    protected function setUp(): void
    {
        $this->pathMock = $this->createMock(Path::class);
        $this->variablesWrapperMock = $this->createMock(PHPVariablesWrapper::class);

        $this->fileHandler = FileHandler::fromParameters(
            $this->pathMock,
            $this->variablesWrapperMock
        );
    }

    public function testCreateFromParameters(): void
    {
        $this->assertInstanceOf(
            FileHandler::class,
            FileHandler::fromParameters(
                $this->pathMock,
                $this->variablesWrapperMock
            )
        );
    }

    public function testLoad(): void
    {
        $this->variablesWrapperMock->method('getFile')->willReturn('<?xml version="1.0" encoding="utf-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>http://test.de/1</loc><lastmod>2020-01-28</lastmod></url></urlset>');
        $this->assertIsString(
            $this->fileHandler->load()
        );
    }

    public function testLoadException()
    {
        $this->variablesWrapperMock->method('getFile')->willThrowException(new \InvalidArgumentException());
        $this->expectException(\InvalidArgumentException::class);
        $this->fileHandler->load();
    }

    public function testSave(): void
    {
        $this->assertEquals(
            true,
            $this->fileHandler->save('<?xml version="1.0" encoding="utf-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>http://test.de/1</loc><lastmod>2020-01-28</lastmod></url></urlset>')
        );
    }

    public function testSaveException()
    {
        $this->variablesWrapperMock->method('putFile')->willThrowException(new \InvalidArgumentException());
        $this->expectException(\InvalidArgumentException::class);
        $this->fileHandler->save('test');
    }
}