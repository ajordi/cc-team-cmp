<?php

namespace App\Domain\Model\Video;

use Ramsey\Uuid\UuidInterface;

class Video
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $tags;
    /**
     * @var string
     */
    private $url;

    public function __construct(UuidInterface $uuid, string $title, array $tags, string $url)
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->tags = $tags;
        $this->url = $url;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function url(): string
    {
        return $this->url;
    }
}
