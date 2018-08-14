<?php


namespace App\Infrastructure\Document;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentProvider as IDocumentProvider;
use App\Domain\Model\Source\FileSource;
use App\Domain\Model\Source\Source;
use App\Infrastructure\File\FileProvider;

class DocumentProvider implements IDocumentProvider
{
    /**
     * @var FileProvider
     */
    private $fileProvider;

    public function __construct(FileProvider $fileProvider)
    {
        $this->fileProvider = $fileProvider;
    }

    public function bySource(Source $source): ?Document
    {
        switch (get_class($source)) {
            case FileSource::class:
                return $this->fileProvider->byFileSource($source);
                break;
        }

        return null;
    }
}
