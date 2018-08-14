<?php

namespace App\Domain\Model\Document;

class Document
{
    const FORMAT_YML = 'yml';
    const FORMAT_JSON = 'json';

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $content;

    public function __construct($format, $content)
    {
        $this->format = $format;
        $this->content = $content;
    }

    public function format(): string
    {
        return $this->format;
    }

    public function content(): string
    {
        return $this->content;
    }
}
