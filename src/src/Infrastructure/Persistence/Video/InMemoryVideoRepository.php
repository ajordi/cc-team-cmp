<?php

namespace App\Infrastructure\Persistence\Video;

use App\Domain\Model\Video\Video;
use App\Domain\Model\Video\VideoRepository;

class InMemoryVideoRepository implements VideoRepository
{
    private $videos = [];

    public function save(Video $video)
    {
        if (isset($this->videos[$video->uuid()->toString()])) {
            $this->videos[$video->uuid()->toString()] = $video;
        }
    }
}
