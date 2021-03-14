<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;

class Factory
{
    public function createSitemapCreator(Configuration $configuration): SitemapCreator
    {
        return new SitemapCreator(
            $this->createDOMDocument(),
            $this->createPHPVariablesWrapper(),
            $this->createPageLoader($configuration),
            $configuration->getPath(),
            $configuration->getName()
        );
    }

    public function createSitemapRemover(Configuration $configuration): SitemapRemover
    {
        return new SitemapRemover(
            $this->createPageLoader($configuration),
            $this->createPageRemoverById($configuration)
        );
    }

    public function createSitemapUpdater(Configuration $configuration): SitemapUpdater
    {
        return new SitemapUpdater(
            $this->createPageLoader($configuration),
            $this->createPageUpdaterById($configuration)
        );
    }

    public function createSitemapEntryBuilder(): SitemapEntryBuilder
    {
        return new SitemapEntryBuilder();
    }

    public function createSitemapEntryEditorBuilder(Configuration $configuration): SitemapEntryEditorBuilder
    {
        return new SitemapEntryEditorBuilder(
            $this->createPageLoader($configuration),
            $this->createSitemapEntryBuilder()
        );
    }

    private function createConnector(Configuration $configuration): Connector
    {
        if ($configuration->getDatabaseTyp()->asString() === 'sqlite') {
            return $this->createSQLiteConnector($configuration);
        }

        if ($configuration->getDatabaseTyp()->asString() === 'mysql') {
            return $this->createMySQLConnector($configuration);
        }

        throw new InvalidTypeException('Database typ is not defined');
    }

    private function createSQLiteConnector(SQLiteConfiguration $configuration): SQLiteConnector
    {
        return new SQLiteConnector($configuration->getName());
    }

    private function createMySQLConnector(MySQLConfiguration $configuration): MySQLConnector
    {
        return new MySQLConnector(
            $configuration->getDatabaseName(),
            $configuration->getDatabasePort(),
            $configuration->getDatabaseHost(),
            $configuration->getDatabaseUsername(),
            $configuration->getDatabasePassword()
        );
    }

    private function createPageLoader(Configuration $configuration): PageLoader
    {
        return new PageLoader(
            $this->createConnector($configuration),
            $this->createSitemapCollectionBuilder()
        );
    }

    private function createPageRemoverById(Configuration $configuration): PageRemoverById
    {
        return new PageRemoverById(
            $this->createConnector($configuration)
        );
    }

    private function createPageUpdaterById(Configuration $configuration): PageUpdaterById
    {
        return new PageUpdaterById(
            $this->createConnector($configuration)
        );
    }

    public function createPageWriter(Configuration $configuration): PageWriter
    {
        return new PageWriter(
            $this->createConnector($configuration)
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

    private function createSitemapCollectionBuilder(): SitemapCollectionBuilder
    {
        return new SitemapCollectionBuilder();
    }
}
