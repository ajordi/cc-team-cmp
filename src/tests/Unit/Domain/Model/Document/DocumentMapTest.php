<?php

namespace Tests\Unit\Domain\Model\Document;

use App\Domain\Model\Document\DocumentMap;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class DocumentMapTest extends TestCase
{
    public function test_it_should_build_valid_document_map()
    {
        $faker = Factory::create();
        $fieldNameUrl = $faker->word;
        $fieldNameTitle = $faker->word;
        $fieldNameTags = $faker->word;

        $documentMap = new DocumentMap($fieldNameUrl, $fieldNameTitle, $fieldNameTags);

        static::assertSame($fieldNameUrl, $documentMap->fieldNameUrl());
        static::assertSame($fieldNameTitle, $documentMap->fieldNameTitle());
        static::assertSame($fieldNameTags, $documentMap->fieldNameTags());
    }
}
