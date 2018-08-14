<?php

namespace Tests\Unit\Infrastructure\Document\DocumentMap\Video;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Infrastructure\Document\DocumentMap\Video\DocumentMapVideo;
use App\Infrastructure\Document\DocumentMap\Video\DocumentMapVideoJson;
use App\Infrastructure\Document\DocumentMap\Video\DocumentMapVideoYaml;
use App\Infrastructure\Exception\InvalidDocumentFormatException;
use PHPUnit\Framework\TestCase;

class DocumentMapVideoTest extends TestCase
{
    public function test_it_should_map_document_with_json_forrmat()
    {
        $expected = [];
        $format = 'json';
        /** @var Document $document */
        $document = $this->prophesize(Document::class);
        $document->format()->shouldBeCalled()->willReturn($format);
        /** @var DocumentMap $documentMap */
        $documentMap = $this->prophesize(DocumentMap::class);
        /** @var DocumentMapVideoJson $documentMapVideoJson */
        $documentMapVideoJson = $this->prophesize(DocumentMapVideoJson::class);
        $documentMapVideoJson->mapDocument($document, $documentMap)->shouldBeCalled()->willReturn($expected);
        /** @var DocumentMapVideoYaml $documentMapVideoYaml */
        $documentMapVideoYaml = $this->prophesize(DocumentMapVideoYaml::class);
        $documentMapVideoYaml->mapDocument()->shouldNotBeCalled();

        $sut = new DocumentMapVideo($documentMapVideoJson->reveal(), $documentMapVideoYaml->reveal());
        $actual = $sut->mapDocument($document->reveal(), $documentMap->reveal());

        static::assertSame($expected, $actual);
    }

    public function test_it_should_map_document_with_yml_forrmat()
    {
        $expected = [];
        $format = 'yml';
        /** @var Document $document */
        $document = $this->prophesize(Document::class);
        $document->format()->shouldBeCalled()->willReturn($format);
        /** @var DocumentMap $documentMap */
        $documentMap = $this->prophesize(DocumentMap::class);
        /** @var DocumentMapVideoJson $documentMapVideoJson */
        $documentMapVideoJson = $this->prophesize(DocumentMapVideoJson::class);
        $documentMapVideoJson->mapDocument()->shouldNotBeCalled();
        /** @var DocumentMapVideoYaml $documentMapVideoYaml */
        $documentMapVideoYaml = $this->prophesize(DocumentMapVideoYaml::class);
        $documentMapVideoYaml->mapDocument($document, $documentMap)->shouldBeCalled()->willReturn($expected);

        $sut = new DocumentMapVideo($documentMapVideoJson->reveal(), $documentMapVideoYaml->reveal());
        $actual = $sut->mapDocument($document->reveal(), $documentMap->reveal());

        static::assertSame($expected, $actual);
    }

    public function test_it_should_throw_exception_for_invalid_document_format()
    {
        static::expectException(InvalidDocumentFormatException::class);

        $format = 'xml';
        /** @var Document $document */
        $document = $this->prophesize(Document::class);
        $document->format()->shouldBeCalled()->willReturn($format);
        /** @var DocumentMap $documentMap */
        $documentMap = $this->prophesize(DocumentMap::class);
        /** @var DocumentMapVideoJson $documentMapVideoJson */
        $documentMapVideoJson = $this->prophesize(DocumentMapVideoJson::class);
        $documentMapVideoJson->mapDocument()->shouldNotBeCalled();
        /** @var DocumentMapVideoYaml $documentMapVideoYaml */
        $documentMapVideoYaml = $this->prophesize(DocumentMapVideoYaml::class);
        $documentMapVideoYaml->mapDocument()->shouldNotBeCalled();

        $sut = new DocumentMapVideo($documentMapVideoJson->reveal(), $documentMapVideoYaml->reveal());
        $sut->mapDocument($document->reveal(), $documentMap->reveal());
    }
}
