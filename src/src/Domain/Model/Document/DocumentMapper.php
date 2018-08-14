<?php

namespace App\Domain\Model\Document;

interface DocumentMapper
{
    public function mapDocument(Document $document, DocumentMap $documentMap): array;
}
