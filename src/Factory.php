<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;

class Factory
{
    public function createSitemapCreator(): SitemapCreator
    {
        return new SitemapCreator(
            $this->createDOMDocument(),
            $this->createPHPVariablesWrapper()
        );
    }

    public function createSitemapRemover(string $databaseName): SitemapRemover
    {
        return new SitemapRemover(
            $this->createSQLitePageLoader($databaseName),
            $this->createSQLitePageRemoverById($databaseName)
        );
    }

    public function createSitemapUpdater(string $databaseName): SitemapUpdater
    {
        return new SitemapUpdater(
            $this->createSQLitePageLoader($databaseName),
            $this->createSQLitePageUpdaterById($databaseName)
        );
    }

    public function createSitemapWriter(string $databaseName): SitemapWriter
    {
        return new SitemapWriter(
            $this->createSQLitePageWriter($databaseName)
        );
    }

    public function createSitemapEntryBuilder(): SitemapEntryBuilder
    {
        return new SitemapEntryBuilder();
    }

    private function createSQLiteConnector(string $databaseName): SQLiteConnector
    {
        return new SQLiteConnector($databaseName);
    }

    private function createSQLitePageLoader(string $databaseName): SQLitePageLoader
    {
        return new SQLitePageLoader(
            $this->createSQLiteConnector($databaseName)
        );
    }

    private function createSQLitePageRemoverById(string $databaseName): SQLitePageRemoverById
    {
        return new SQLitePageRemoverById(
            $this->createSQLiteConnector($databaseName)
        );
    }

    private function createSQLitePageUpdaterById(string $databaseName): SQLitePageUpdaterById
    {
        return new SQLitePageUpdaterById(
            $this->createSQLiteConnector($databaseName)
        );
    }

    private function createSQLitePageWriter(string $databaseName): SQLitePageWriter
    {
        return new SQLitePageWriter(
            $this->createSQLiteConnector($databaseName)
        );
    }

    private function createDOMDocument(): DOMDocument
    {
        return new DOMDocument('1.0', 'utf-8');
    }

    private function createPHPVariablesWrapper(): PHPVariablesWrapper
    {
        return new PHPVariablesWrapper();
    }
}
