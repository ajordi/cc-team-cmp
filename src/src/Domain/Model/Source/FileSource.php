<?php

namespace App\Domain\Model\Source;

use App\Domain\Model\Document\DocumentMap;

class FileSource implements Source
{
    /**
     * @var Source
     */
    private $source;

    /**
     * @var string
     */
    private $filePath;


    public function __construct(Source $source, string $filePath)
    {
        $this->source = $source;
        $this->filePath = $filePath;
    }

    public function filePath(): string
    {
        return $this->filePath;
    }

    public function name(): string
    {
        return $this->source->name();
    }


    public function documentMap(): DocumentMap
    {
        return $this->source->documentMap();
    }


    public function contentFormat(): string
    {
        return $this->source->contentFormat();
    }
}
