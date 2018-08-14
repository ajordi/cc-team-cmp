<?php

namespace Tests\Unit\Domain\Model\Document;

use App\Domain\Model\Document\Document;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    public function test_it_should_build_valid_document()
    {
        $faker = Factory::create();

        $format = $faker->word;
        $content = $faker->text;

        $document = new Document($format, $content);

        static::assertSame('yml', Document::FORMAT_YML);
        static::assertSame('json', Document::FORMAT_JSON);
        static::assertSame($format, $document->format());
        static::assertSame($content, $document->content());
    }
}
