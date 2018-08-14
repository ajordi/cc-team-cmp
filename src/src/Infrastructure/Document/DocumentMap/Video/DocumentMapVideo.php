<?php

namespace App\Infrastructure\Document\DocumentMap\Video;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Domain\Model\Document\DocumentMapper;
use App\Infrastructure\Exception\InvalidDocumentFormatException;

class DocumentMapVideo implements DocumentMapper
{
    /**
     * @var DocumentMapVideoJson
     */
    private $documentMapVideoJson;

    /**
     * @var DocumentMapVideoYaml
     */
    private $documentMapVideoYaml;

    public function __construct(DocumentMapVideoJson $documentMapVideoJson, DocumentMapVideoYaml $documentMapVideoYaml)
    {
        $this->documentMapVideoJson = $documentMapVideoJson;
        $this->documentMapVideoYaml = $documentMapVideoYaml;
    }

    /**
     * @param Document $document
     * @param DocumentMap $documentMap
     * @return array
     * @throws InvalidDocumentFormatException
     * @throws \App\Infrastructure\Exception\SyntaxException
     */
    public function mapDocument(Document $document, DocumentMap $documentMap): array
    {
        $documentMapVideo = null;

        switch ($document->format()) {
            case Document::FORMAT_JSON:
                $documentMapVideo = $this->documentMapVideoJson;
                break;
            case Document::FORMAT_YML:
                $documentMapVideo = $this->documentMapVideoYaml;
                break;
        }

        if (null === $documentMapVideo) {
            throw new InvalidDocumentFormatException();
        }

        return $documentMapVideo->mapDocument($document, $documentMap);
    }
}
