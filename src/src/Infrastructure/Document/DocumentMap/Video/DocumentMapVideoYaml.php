<?php

namespace App\Infrastructure\Document\DocumentMap\Video;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Domain\Model\Document\DocumentMapper;
use App\Domain\Model\Video\Video;
use Symfony\Component\Yaml\Yaml;

class DocumentMapVideoYaml extends BaseDocumentMapVideo implements DocumentMapper
{
    public function mapDocument(Document $document, DocumentMap $documentMap): array
    {
        $data = Yaml::parse($document->content());
        $videos = [];
        foreach ($data as $item) {
            $videos[] = new Video(
                $this->idGenerator->next(),
                $item[$documentMap->fieldNameTitle()],
                isset($item[$documentMap->fieldNameTags()])
                    ? explode(', ', $item[$documentMap->fieldNameTags()])
                    : [],
                $item[$documentMap->fieldNameUrl()]
            );
        }

        return $videos;
    }
}
