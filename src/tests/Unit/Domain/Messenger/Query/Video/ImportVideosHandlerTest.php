<?php

namespace Tests\Unit\Domain\Messenger\Query\Video;

use App\Application\Service\Video\DTO\ImportVideoDTO;
use App\Domain\Messenger\Query\Video\ImportVideos;
use App\Domain\Messenger\Query\Video\ImportVideosHandler;
use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Domain\Model\Document\DocumentMapper;
use App\Domain\Model\Document\DocumentProvider;
use App\Domain\Model\Source\Source;
use App\Domain\Model\Source\SourceRepository;
use App\Domain\Model\Video\Video;
use App\Domain\Model\Video\VideoRepository;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ImportVideosHandlerTest extends TestCase
{
    public function test_it_should_handle_import_videos_query_with_no_videos()
    {
        $expected = [];
        $sourceName = 'some-source';

        /** @var DocumentMap $documentMap */
        $documentMap = $this->prophesize(DocumentMap::class);
        /** @var Source $source */
        $source = $this->prophesize(Source::class);
        $source->documentMap()->shouldBeCalled()->willReturn($documentMap);
        /** @var Document $document */
        $document = $this->prophesize(Document::class);
        /** @var ImportVideos $importVideos */
        $importVideos = $this->prophesize(ImportVideos::class);
        $importVideos->source()->shouldBeCalled()->willReturn($sourceName);
        /** @var SourceRepository $sourceRepository */
        $sourceRepository = $this->prophesize(SourceRepository::class);
        $sourceRepository->byName($sourceName)->shouldBeCalled()->willReturn($source);
        /** @var DocumentProvider $documentProvider */
        $documentProvider = $this->prophesize(DocumentProvider::class);
        $documentProvider->bySource($source)->shouldBecalled()->willReturn($document);
        /** @var DocumentMapper $documentMapper */
        $documentMapper = $this->prophesize(DocumentMapper::class);
        $documentMapper->mapDocument($document, $documentMap)->shouldBeCalled()->willReturn($expected);
        /** @var VideoRepository $videoRepository */
        $videoRepository = $this->prophesize(VideoRepository::class);

        $impotVideosHandler = new ImportVideosHandler(
            $sourceRepository->reveal(),
            $documentProvider->reveal(),
            $documentMapper->reveal(),
            $videoRepository->reveal()
        );

        $actual = $impotVideosHandler->handleImportVideos($importVideos->reveal());

        static::assertEquals($expected, $actual);
    }

    public function test_it_should_handle_import_videos_query_with_one_video()
    {
        $faker = Factory::create();
        $sourceName = 'some-source';
        $id = Uuid::uuid4();
        $title = $faker->title;
        $url = $faker->url;
        $tags = $faker->rgbColorAsArray;

        /** @var Video $video */
        $video = $this->prophesize(Video::class);
        $video->uuid()->shouldBeCalledTimes(1)->willReturn($id);
        $video->title()->shouldBeCalledTimes(1)->willReturn($title);
        $video->url()->shouldBeCalledTimes(1)->willReturn($url);
        $video->tags()->shouldBeCalledTimes(1)->willReturn($tags);
        $videos = [$video];

        /** @var ImportVideoDTO $importedVideo */
        $importedVideo = new ImportVideoDTO($id->toString(), $title, $url, $tags);
        $expected = [$importedVideo];

        /** @var DocumentMap $documentMap */
        $documentMap = $this->prophesize(DocumentMap::class);

        /** @var Source $source */
        $source = $this->prophesize(Source::class);
        $source->documentMap()->shouldBeCalled()->willReturn($documentMap);

        /** @var Document $document */
        $document = $this->prophesize(Document::class);

        /** @var ImportVideos $importVideos */
        $importVideos = $this->prophesize(ImportVideos::class);
        $importVideos->source()->shouldBeCalled()->willReturn($sourceName);

        /** @var SourceRepository $sourceRepository */
        $sourceRepository = $this->prophesize(SourceRepository::class);
        $sourceRepository->byName($sourceName)->shouldBeCalled()->willReturn($source);

        /** @var DocumentProvider $documentProvider */
        $documentProvider = $this->prophesize(DocumentProvider::class);
        $documentProvider->bySource($source)->shouldBecalled()->willReturn($document);

        /** @var DocumentMapper $documentMapper */
        $documentMapper = $this->prophesize(DocumentMapper::class);
        $documentMapper->mapDocument($document, $documentMap)->shouldBeCalled()->willReturn($videos);

        /** @var VideoRepository $videoRepository */
        $videoRepository = $this->prophesize(VideoRepository::class);

        $impotVideosHandler = new ImportVideosHandler(
            $sourceRepository->reveal(),
            $documentProvider->reveal(),
            $documentMapper->reveal(),
            $videoRepository->reveal()
        );
        $actual = $impotVideosHandler->handleImportVideos($importVideos->reveal());

        static::assertEquals($expected, $actual);
    }
}
