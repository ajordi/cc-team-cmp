<?php

namespace App\Domain\Model\Video;

interface VideoRepository
{
    public function save(Video $video);
}
