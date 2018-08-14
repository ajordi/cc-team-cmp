<?php

namespace App\Domain\Model\Document;

class DocumentMap
{
    /**
     * @var string
     */
    private $fieldNameUrl;

    /**
     * @var string
     */
    private $fieldNameTitle;

    /**
     * @var string
     */
    private $fieldNameTags;

    public function __construct(string $fieldNameUrl, string $fieldNameTitle, string $fieldNameTags)
    {
        $this->fieldNameUrl = $fieldNameUrl;
        $this->fieldNameTitle = $fieldNameTitle;
        $this->fieldNameTags = $fieldNameTags;
    }

    public function fieldNameUrl(): string
    {
        return $this->fieldNameUrl;
    }

    public function fieldNameTitle(): string
    {
        return $this->fieldNameTitle;
    }

    public function fieldNameTags(): string
    {
        return $this->fieldNameTags;
    }
}
