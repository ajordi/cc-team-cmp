<?php

namespace App\Application\Service\Video\DTO;

use App\Application\Service\DTO;

class ImportVideoDTO implements DTO
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $url;
    /**
     * @var array
     */
    private $tags;

    public function __construct(string $id, string $title, string $url, array $tags)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->tags = $tags;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'url' => $this->url(),
            'tags' => implode(', ', $this->tags())
        ];
    }
}
