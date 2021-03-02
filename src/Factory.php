<?php

declare(strict_types=1);

namespace elektrodancer\sitemap;

use DOMDocument;

class Factory
{
    public function createSitemapCreator(SitemapConfiguration $configuration): SitemapCreator
    {
        return new SitemapCreator(
            $this->createDOMDocument(),
            $this->createPHPVariablesWrapper(),
            $this->createPageLoader($configuration),
            $configuration->getPath()
        );
    }

    public function createSitemapRemover(SitemapConfiguration $configuration): SitemapRemover
    {
        return new SitemapRemover(
            $this->createPageLoader($configuration),
            $this->createPageRemoverById($configuration)
        );
    }

    public function createSitemapUpdater(SitemapConfiguration $configuration): SitemapUpdater
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

    private function createConnector(SitemapConfiguration $configuration): Connector
    {
        if ($configuration->getTyp()->asString() === 'sqlite') {
            return new SQLiteConnector($configuration->getName());
        }

        if ($configuration->getTyp()->asString() === 'mysql') {
            return new MySQLConnector(
                $configuration->getDatabaseName(),
                $configuration->getDatabasePort(),
                $configuration->getDatabaseHost(),
                $configuration->getDatabaseUsername(),
                $configuration->getDatabasePassword()
            );
        }

        throw new InvalidTypeException('Database typ is not defined');
    }

    private function createPageLoader(SitemapConfiguration $configuration): PageLoader
    {
        return new PageLoader(
            $this->createConnector($configuration),
            $this->createSitemapCollectionBuilder()
        );
    }

    private function createPageRemoverById(SitemapConfiguration $configuration): PageRemoverById
    {
        return new PageRemoverById(
            $this->createConnector($configuration)
        );
    }

    private function createPageUpdaterById(SitemapConfiguration $configuration): PageUpdaterById
    {
        return new PageUpdaterById(
            $this->createConnector($configuration)
        );
    }

    public function createPageWriter(SitemapConfiguration $configuration): PageWriter
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
