<?php

namespace App\Domain\Messenger\Query\Video;

use App\Application\Service\Video\DTO\ImportVideoDTO;
use App\Domain\Model\Document\DocumentMapper;
use App\Domain\Model\Document\DocumentProvider;
use App\Domain\Model\Source\SourceRepository;
use App\Domain\Model\Video\Video;
use App\Domain\Model\Video\VideoRepository;
use App\Infrastructure\Messenger\SimpleQueryHandler;

class ImportVideosHandler extends SimpleQueryHandler
{
    /**
     * @var SourceRepository
     */
    private $sourceRepository;

    /**
     * @var DocumentProvider
     */
    private $documentProvider;

    /**
     * @var DocumentMapper
     */
    private $documentMapper;

    /**
     * @var VideoRepository
     */
    private $videoRepository;

    public function __construct(
        SourceRepository $sourceRepository,
        DocumentProvider $documentProvider,
        DocumentMapper $documentMapper,
        VideoRepository $videoRepository
    ) {
        $this->sourceRepository = $sourceRepository;
        $this->documentProvider = $documentProvider;
        $this->documentMapper = $documentMapper;
        $this->videoRepository = $videoRepository;
    }

    public function handleImportVideos(ImportVideos $importVideos)
    {
        $source = $this->sourceRepository->byName($importVideos->source());
        $document = $this->documentProvider->bySource($source);
        /** @var Video[] $videos */
        $videos = $this->documentMapper->mapDocument($document, $source->documentMap());
        $importedVideosDTOs = [];
        foreach ($videos as $video) {
            $this->videoRepository->save($video);
            $importedVideosDTOs[] = new ImportVideoDTO(
                $video->uuid()->toString(),
                $video->title(),
                $video->url(),
                $video->tags()
            );
        }

        return $importedVideosDTOs;
    }
}
