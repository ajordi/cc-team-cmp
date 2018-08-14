<?php

namespace App\Domain\Model\Source;

use App\Domain\Model\Document\DocumentMap;

class BaseSource implements Source
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var DocumentMap
     */
    private $documentMap;
    /**
     * @var string
     */
    private $format;

    public function __construct(string $name, DocumentMap $documentMap, string $format)
    {
        $this->name = $name;
        $this->documentMap = $documentMap;
        $this->format = $format;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function documentMap(): DocumentMap
    {
        return $this->documentMap;
    }

    public function contentFormat(): string
    {
        return $this->format;
    }
}
