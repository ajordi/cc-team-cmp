<?php

namespace Tests\Unit\Application\Service\Video\DTO;

use App\Application\Service\Video\DTO\ImportVideoDTO;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

class ImportVideoDTOTest extends TestCase
{
    public function test_it_should_build_import_video_dto()
    {
        $faker = Factory::create();

        $id = $faker->uuid;
        $title = $faker->title;
        $url = $faker->url;
        $tags = $faker->rgbColorAsArray;

        $expectedSerialization = [
            'id' => $id,
            'title' => $title,
            'url' => $url,
            'tags' => implode(', ', $tags)
        ];

        $importVideoDTO  = new ImportVideoDTO($id, $title, $url, $tags);

        static::assertSame($id, $importVideoDTO->id());
        static::assertSame($title, $importVideoDTO->title());
        static::assertSame($url, $importVideoDTO->url());
        static::assertSame($tags, $importVideoDTO->tags());
        static::assertSame($expectedSerialization, $importVideoDTO->serialize());
    }
}
