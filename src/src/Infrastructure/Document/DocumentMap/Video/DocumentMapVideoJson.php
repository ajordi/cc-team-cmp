<?php

namespace App\Infrastructure\Document\DocumentMap\Video;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Domain\Model\Document\DocumentMapper;
use App\Domain\Model\Video\Video;
use App\Infrastructure\Exception\SyntaxException;

class DocumentMapVideoJson extends BaseDocumentMapVideo implements DocumentMapper
{
    /**
     * @param Document $document
     * @param DocumentMap $documentMap
     * @return Video[]
     * @throws SyntaxException
     */
    public function mapDocument(Document $document, DocumentMap $documentMap): array
    {
        $data = json_decode($document->content());

        if (json_last_error()) {
            throw new SyntaxException(json_last_error_msg());
        }

        $videos = [];
        foreach ($data->videos as $item) {
            $videos[] = new Video(
                $this->idGenerator->next(),
                $item->{$documentMap->fieldNameTitle()},
                isset($item->{$documentMap->fieldNameTags()})
                    ? $item->{$documentMap->fieldNameTags()}
                    : [],
                $item->{$documentMap->fieldNameUrl()}
            );
        }

        return $videos;
    }
}
