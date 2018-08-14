<?php

namespace App\Infrastructure\File;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Source\FileSource;
use App\Infrastructure\Exception\FileNotExistException;

class FileProvider
{
    /**
     * @param FileSource $source
     * @return Document|null
     * @throws FileNotExistException
     */
    public function byFileSource(FileSource $source): ?Document
    {
        if (!file_exists($source->filePath())) {
            throw new FileNotExistException(sprintf('File not exists: %s', $source->filePath()));
        }

        return new Document(
            $source->contentFormat(),
            file_get_contents($source->filePath())
        );
    }
}
