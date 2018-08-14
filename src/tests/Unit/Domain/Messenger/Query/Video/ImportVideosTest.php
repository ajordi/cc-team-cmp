<?php

namespace Tests\Unit\Domain\Messenger\Query\Video;

use App\Domain\Messenger\Query\Video\ImportVideos;
use PHPUnit\Framework\TestCase;

class ImportVideosTest extends TestCase
{
    public function test_it_should_build_import_videos_query()
    {
        $source = 'some-source';

        $importVideos  = new ImportVideos($source);

        static::assertSame($source, $importVideos->source());
        static::assertEquals($importVideos, ImportVideos::fromArray(['source' => $source]));
    }
}
